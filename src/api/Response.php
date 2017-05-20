<?php
namespace LibWeb\api;

class Response {

	private $code_          = 200;
	private $data_          = null;
	private $headers_       = array();
	private $raw_           = false;
	
	/// Get the response data
	public function getData() { return $this->data_; }
	/// Get the headers
	public function getHeaders() { return $this->headers_; }
	/// Get the status
	public function getCode() { return $this->code_; }
	/// Check if response is raw
	public function getRaw() { return $this->raw_; }
	/// Set the data to be sent
	public function data( $data ) {
		$this->raw_  = false;
		$this->data_ = $data;
	}
	/// Set the response as file
	public function file( $path, $name = null, $inline = true ) {
		$this->raw_  = true;
		if ( $name == null )
			$name = basename( $path );
		$this->headers_['content-disposition'] = ( $inline ? 'inline' : 'attachment' ).'; filename="'.$name.'"';
		$this->data_ = function() use ( $path ) {
			readfile( $path );
		};
	}
	/// Send a raw data
	public function raw( $data ) {
		$this->raw_  = true;
		$this->data_ = $data;
	}
	/// Set the response code
	public function code( $code ) {
		$this->code_ = $code;
	}
	/// Set the header
	public function header( $name, $value ) {
		$name = strtolower( trim( $name ) );
		$this->headers_[ $name ] = $value;
	}
};