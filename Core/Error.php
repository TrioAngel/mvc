<?php


namespace Core;

/*Error and exception handler
*/


class Error {

  /*Error handler. Convert all errors to Exceptions by throwing an Error Exception.
  @param int $level Error level
  @param string @message Error message
  @param string $file Filename the error was raised in
  @param int @line Line number in the file

  @return void*/
  public static function errorHandler($level,$message,$file, $line){
    if(error_reporting() !== 0){
      throw new \ErrorException($message, 0, $level, $file, $line);
    }
  }

  /*
   * Exception handler
   * @param Exception $exception the exception
   * @return void
   * */
  public static function exceptionHandler($exception){
    echo "<h1>Fatal error</h1>";
    echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
    echo "<p>Message: '" . $exception->getMessage() . "'</p>";
    echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
    echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
  }

}