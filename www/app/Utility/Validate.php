<?php

namespace App\Utility;

/**
 * Validate:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Validate {

    /** @var Database */
    private $_Db = null;

    /** @var array */
    private $_errors = [];

    /** @var boolean */
    private $_passed = false;

    /** @var integer */
    private $_recordID = null;

    /** @var array */
    private $_source = [];

    /**
     * Construct:
     * @access public
     * @param array $source
     * @param integer $recordID [optional]
     * @since 1.0.2
     */
    public function __construct(array $source, $recordID = null) {
        $this->_Db = Database::getInstance();
        $this->_recordID = $recordID;
        $this->_source = $source;
    }

    /**
     * Add Error:
     * @access private
     * @param string $input
     * @param string $error
     * @since 1.0.2
     */
    private function _addError($input, $error) {
        $this->_errors[$input][] = str_replace(['-', '_'], ' ', ucfirst(strtolower($error)));
    }

    /**
     * Check:
     * @access public
     * @param array $inputs
     * @return Validate
     * @since 1.0.2
     */
    public function check(array $inputs) {
        $this->_errors = [];
        $this->_passed = false;
        foreach ($inputs as $input => $rules) {
            if (isset($this->_source[$input])) {
                $value = trim($this->_source[$input]);
                $this->_validate($input, $value, $rules);
            } else {
                $this->_addError($input, Text::get("VALIDATE_MISSING_INPUT", ["%ITEM%" => $input]));
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    /**
     * Errors:
     * @access public
     * @return array
     * @since 1.0.2
     */
    public function errors() {
        return($this->_errors);
    }

    /**
     * Passed:
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public function passed() {
        return($this->_passed);
    }

    /**
     * Validate:
     * @access private
     * @param string $input
     * @param string $value
     * @param array $rules
     * @return void
     * @since 1.0.2
     */
    private function _validate($input, $value, array $rules) {
        foreach ($rules as $rule => $ruleValue) {
            if (($rule === "required" and $ruleValue === true) and empty($value)) {
                $this->_addError($input, Text::get("VALIDATE_REQUIRED_RULE", ["%ITEM%" => $input]));
            } elseif (!empty($value)) {
                $methodName = lcfirst(ucwords(strtolower(str_replace(["-", "_"], "", $rule)))) . "Rule";
                if (method_exists($this, $methodName)) {
                    $this->{$methodName}($input, $value, $ruleValue);
                } else {
                    $this->_addError($input, Text::get("VALIDATE_MISSING_METHOD", ["%ITEM%" => $input]));
                }
            }
        }
    }

    /**
     * Filter Rule:
     * @access protected
     * @param string $input
     * @param string $value
     * @param string $ruleValue
     * @return void
     * @since 1.0.2
     */
    protected function filterRule($input, $value, $ruleValue) {
        switch ($ruleValue) {
            // Email
            case "email":
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $data = [
                        "%ITEM%" => $input,
                        "%RULE_VALUE%" => $ruleValue
                    ];
                    $this->_addError($input, Text::get("VALIDATE_FILTER_RULE", $data));
                }
                break;
        }
    }

    /**
     * Matches Rule:
     * @access protected
     * @param string $input
     * @param string $value
     * @param string $ruleValue
     * @return void
     * @since 1.0.2
     */
    protected function matchesRule($input, $value, $ruleValue) {
        if ($value != $this->_source[$ruleValue]) {
            $data = [
                "%ITEM%" => $input,
                "%RULE_VALUE%" => $ruleValue
            ];
            $this->_addError($input, Text::get("VALIDATE_MATCHES_RULE", $data));
        }
    }

    /**
     * Max Characters Rule:
     * @access protected
     * @param string $input
     * @param string $value
     * @param string $ruleValue
     * @return void
     * @since 1.0.2
     */
    protected function maxCharactersRule($input, $value, $ruleValue) {
        if (strlen($value) > $ruleValue) {
            $data = [
                "%ITEM%" => $input,
                "%RULE_VALUE%" => $ruleValue
            ];
            $this->_addError($input, Text::get("VALIDATE_MAX_CHARACTERS_RULE", $data));
        }
    }

    /**
     * Min Characters Rule:
     * @access protected
     * @param string $input
     * @param string $value
     * @param string $ruleValue
     * @return void
     * @since 1.0.2
     */
    protected function minCharactersRule($input, $value, $ruleValue) {
        if (strlen($value) < $ruleValue) {
            $data = [
                "%ITEM%" => $input,
                "%RULE_VALUE%" => $ruleValue
            ];
            $this->_addError($input, Text::get("VALIDATE_MIN_CHARACTERS_RULE", $data));
        }
    }

    /**
     * Required Rule:
     * @access protected
     * @param string $input
     * @param string $value
     * @param string $ruleValue
     * @return void
     * @since 1.0.2
     */
    protected function requiredRule($input, $value, $ruleValue) {
        if ($ruleValue === true and empty($value)) {
            $this->_addError($input, Text::get("VALIDATE_REQUIRED_RULE", ["%ITEM%" => $input]));
        }
    }

    /**
     * Unique Rule:
     * @access protected
     * @param string $input
     * @param string $value
     * @param string $ruleValue
     * @return void
     * @since 1.0.2
     */
    protected function uniqueRule($input, $value, $ruleValue) {
        $check = $this->_Db->select($ruleValue, [$input, "=", $value]);
        if ($check->count()) {
            if ($this->_recordID and $check->first()->id === $this->_recordID) {
                return;
            }
            $this->_addError($input, Text::get("VALIDATE_UNIQUE_RULE", ["%ITEM%" => $input]));
        }
    }

}
