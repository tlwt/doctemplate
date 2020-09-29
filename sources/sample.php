<?php
/**
 * @file sample.php
 * @author Till Witt
 * @date 2020-09-28
 * @brief a doxygen example file
 */

 /**
  * class to provide some doxygen documentation examples
  **/

class sampleClass {

  /**
   * constructor
   * @param none
   * @return none
   **/
  function __construct() {
    $this->msg = "Hello World";
  }

  /**
   * appends $input to any given string
   * @param string $input
   * @return string success
   **/
  function appendText($input) {
    $this->msg = $this->msg . $input;
    return "success";
  }

  /**
   * outputs a message to the system via echo
   * @param none
   * @return none
   **/
  function output() {
    echo $this->msg . "\n";
  }

}

/** \brief demo execution variable **/
$test = new sampleClass;
$test->output();
echo $test->appendText("blah2");
$test->output();

?>
