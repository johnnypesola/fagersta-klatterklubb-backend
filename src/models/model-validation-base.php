<?php

namespace FKK\models;

class ModelValidationBase {
    public function IsValidString($stringName, $stringContent, $constraints = []) {
        // Default values
        if(!isset($constraints['minLength'])) {
            $constraints['minLength'] = 1;
        }
        if(!isset($constraints['maxLength'])) {
            $constraints['maxLength'] = 100;
        }
        if(!isset($constraints['regex'])) {
            $constraints['regex'] = '/[^a-z_\-0-9åäöÅÄÖ!?#$@%&\=´`~^éèëÊËÈÉ+\/.,_*\'" ]/i';
        }
        // Default messages
        if(!isset($constraints['emptyMsg'])) {
            $constraints['emptyMsg'] = "$stringName saknas";
        }
        if(!isset($constraints['minLengthMsg'])) {
            $constraints['minLengthMsg'] = "$stringName har för få tecken, det borde ha minst " . $constraints['minLength'] . " tecken.";
        }
        if(!isset($constraints['maxLengthMsg'])) {
            $constraints['maxLengthMsg'] = "$stringName har för många tecken. Max antal tecken är " . $constraints['maxLength'] . ".";
        }
        if(!isset($constraints['regexMsg'])) {
            $constraints['regexMsg'] = "$stringName innehåller ogiltiga tecken.";
        }
        // Check if $stringContent is an object
        if(is_object($stringContent)) {
            throw new \Exception($constraints['regexMsg']);
        }
        // Check if $stringContent is empty
        if($constraints['minLength'] == 1 && trim(strlen($stringContent)) == 0) {
            throw new \Exception($constraints['emptyMsg']);
        }
        // Check if $stringContent is too short
        if($constraints['minLength'] > 1 && trim(strlen($stringContent)) < $constraints['minLength']) {
            throw new \Exception($constraints['minLengthMsg']);
        }
        // Check if $stringContent is too long
        if(strlen($stringContent) > $constraints['maxLength']) {
            throw new \Exception($constraints['maxLengthMsg']);
        }
        // Check if $stringContent is valid
        if(preg_match($constraints['regex'], $stringContent)) {
            throw new \Exception($constraints['regexMsg']);
        }
        return true;
    }
    public function IsValidInt($intName, $intContent, $constraints = []) {
        // Default values
        if(!isset($constraints['minValue'])) {
            $constraints['minValue'] = ~PHP_INT_MAX; // PHP_INT_MAX is available in php 7.0.0<
        }
        if(!isset($constraints['maxValue'])) {
            $constraints['maxValue'] = PHP_INT_MAX;
        }
        if(!isset($constraints['allowNull'])) {
            $constraints['allowNull'] = false;
        }
        // Default messages
        if(!isset($constraints['minValueMsg'])) {
            $constraints['minValueMsg'] = "$intName är för lågt. " . $constraints['minValue'] . " är det lägsta tillåtna värdet.";
        }
        if(!isset($constraints['maxValueMsg'])) {
            $constraints['maxValueMsg'] = "$intName är för högt. " . $constraints['maxValue'] . " är det högsta tillåtna värdet.";
        }
        if(!isset($constraints['notNumericMsg'])) {
            $constraints['notNumericMsg'] = "$intName ska vara ett nummer.";
        }
        // Check if $intContent is not numeric
        if(
            !($constraints['allowNull'] && 
            is_null($intContent)) && 
            !is_numeric($intContent) 
            || is_float($intContent)
        ) {
            throw new \Exception($constraints['notNumericMsg']);
        }
        // Check if $intContent is too low
        if($intContent < $constraints['minValue']) {
            throw new \Exception($constraints['minValueMsg']);
        }
        // Check if $intContent is too large
        if($intContent > $constraints['maxValue']) {
            throw new \Exception($constraints['maxValueMsg']);
        }
        return true;
    }
    public function IsValidFloat($floatName, $floatContent, $constraints = []) {
        // Default values
        if(!isset($constraints['minValue'])) {
            $constraints['minValue'] = ~PHP_INT_MAX; // PHP_INT_MAX is available in php 7.0.0< & No specific float min value available in php
        }
        if(!isset($constraints['maxValue'])) {
            $constraints['maxValue'] = PHP_INT_MAX; // No specific float max value available in php
        }
        // Default messages
        if(!isset($constraints['minValueMsg'])) {
            $constraints['minValueMsg'] = "$floatName värdet är för lågt. " . $constraints['minValue'] . " är det lägsta tillåtna värdet.";
        }
        if(!isset($constraints['maxValueMsg'])) {
            $constraints['maxValueMsg'] = "$floatName värdet är för högt. " . $constraints['maxValue'] . " är det högsta tillåtna värdet.";
        }
        if(!isset($constraints['notFloatMsg'])) {
            $constraints['notFloatMsg'] = "$floatName måste vara ett decimalvärde.";
        }
        // Check if $floatContent is not a float
        if(!is_float($floatContent)) {
            throw new \Exception($constraints['notFloatMsg']);
        }
        // Check if $floatContent is too low
        if($floatContent < $constraints['minValue']) {
            throw new \Exception($constraints['minValueMsg']);
        }
        // Check if $stringContent is too large
        if($floatContent > $constraints['maxValue']) {
            throw new \Exception($constraints['maxValueMsg']);
        }
        return true;
    }
    public function IsValidBool($boolName, $boolContent, $constraints = [])
    {
        // Default messages
        if(!isset($constraints['notBoolMsg'])) {
            $constraints['notBoolMsg'] = "$boolName måste vara antingen sant eller falskt.";
        }
        // Check if its a valid bool
        if(!is_bool($boolContent))
        {
            throw new \Exception($constraints['notBoolMsg']);
        }
        return true;
    }
    protected function IsClassType($objName, $objContent, $constraints = [])
    {
        // Return false if classType is not defined
        if(!isset($constraints['classType'])) {
            $constraints['classType'] = 'Unspecified';
        }
        // Default settings
        if(!isset($constraints['allowNull'])) {
            $constraints['allowNull'] = false;
        }
        // Default messages
        if(!isset($constraints['notClassTypeMsg'])) {
            $constraints['notClassTypeMsg'] = "$objName måste vara ett objekt av typen: " . $constraints['classType'];
        }
        // Check if its a valid class
        if(
            !($constraints['allowNull'] && 
            is_null($objContent)) && 
            !($objContent instanceof $constraints['classType'])
        ){
            throw new \Exception($constraints['notClassTypeMsg']);
        }
        return true;
    }
} 