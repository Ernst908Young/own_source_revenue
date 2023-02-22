<?php

/**
 * this file contains all the functions related to emails, fetching email from the account or pushing the emails
 *@author Hemant thakur
 */
class EmailUtility
{
	
	private $username="helpdesk.investuttarakhand@gmail.com";
	private $password="InvestUK01928";
	private $host="smtp.gmail.com";
	function __construct($host,$uname,$passwd)
	{
		if(empty($uname) || empty($passwd) || empty($host))
			throw new Exception("Parameters are missing.", 409);
		$this->username=$uname;
		$this->password=$passwd;
		$this->host=$host;
			
	}
	/**
	* this function is used to initiate the connection with mail server for poping up the email messages
	*@author Hemant Thakur
	*@param string host, string username, string password
	*@return resource
	*/
	function imapConnect(){
		return imap_open($this->host, $this->username, $this->password);
	}
	/**
	* this function is used to search filter of the emails with requested criteria
	*@author Hemant thakur
	*@param resource imapConnection, String Search
	*@return array of objects
	*/
	function searchEmails($imapConnection,$search,$SE_UID=null){
		return imap_search($imapConnection, $search,$SE_UID);
	}
	/**
	* this function is used to get the email headers
	*@author Hemant Thakur
	*@param resource connection,int messageId
	*@return array
	*/
	function fetchEmailHeadersUsingMsgId($imapConnection,$msgId){
		return imap_header($imapConnection, $msgId);
	}
	/**
	* this function is used to get the email headers from UID
	*@author Hemant thakur
	*@param resource connection,int messageId
	*@return array
	*/
	function fetchEmailHeadersUsingUID($imapConnection,$UID){
		$headerText = imap_fetchbody($imapConnection, $UID, '0', FT_UID);
		return imap_rfc822_parse_headers($headerText);
	}
	/**
	* this function is used to fetch the email structure 
	*@author Hemant thakur
	*@param resource connection, int msgId
	*@return array
	*/
	function fetchEmailStructure($imapConnection,$msgId,$FT_UID=0){
		return imap_fetchstructure($imapConnection,$msgId,$FT_UID);
	}
	
	/**
	* this function is used to get the emails parts
	*@author Hemant thakur
	*@param resource $imapConnection, int messageId, int prefix
	*@return array of objects
	*/
	function fetchEmailParts($imap,$mid,$part,$prefix) 
	{    
	    $attachments=array(); 
	    $attachments[$prefix]=$this->decodeEmailPart($imap,$mid,$part,$prefix,FT_UID);
	    if (isset($part->parts)) // multipart 
	    { 
	        $prefix = ($prefix == "0")?"":"$prefix."; 
	        foreach ($part->parts as $number=>$subpart) 
	            $attachments=array_merge($attachments, $this->fetchEmailParts($imap,$mid,$subpart,$prefix.($number+1))); 
	    } 
	    return $attachments; 
	} 
	/**
	* this function is used to decode the email body (if any) and find the attachment of the email
	*@author Hemant thakur
	*@param resource $imapConnection, int messageId, array parts int prefix
	*@return array
	*/
	function decodeEmailPart($connection,$message_number,$part,$prefix,$bitMask) 
	{ 
	    $attachment = array(); 

	    if($part->ifdparameters) { 
	        foreach($part->dparameters as $object) { 
	            if(strtolower($object->attribute) == 'filename') { 
	                $attachment['is_attachment'] = true; 
	                $attachment['filename'] = $object->value; 
	            } 
	        } 
	    } 
	    if($part->ifparameters) { 
	        foreach($part->parameters as $object) { 
	            if(strtolower($object->attribute) == 'name') { 
	                $attachment['is_attachment'] = true; 
	                $attachment['name'] = $object->value; 
	            } 
	        } 
	    } 
	    // $attachment['data'] = imap_fetchbody($connection, $message_number, $prefix, FT_PEEK); 
	    $attachment['data'] = imap_fetchbody($connection, $message_number, $prefix, $bitMask); 
	    if($part->encoding == 3) { // 3 = BASE64 
	        $attachment['data'] = base64_decode($attachment['data']); 
	    } 
	    elseif($part->encoding == 4) { // 4 = QUOTED-PRINTABLE 
	        $attachment['data'] = quoted_printable_decode($attachment['data']); 
	    } 
	    return($attachment); 
	} 
	/**
	* this function is used to close the mail server connection. it is necessary to close the connection after initialization. otherwise if too many connection are remain opened then some mail server like gmail may get block the account
	*@author Hemant Thakur
	*@param resource connection
	*@return boolean
	*/
	function closeImapConnection($imapConnection){
		return imap_close($imapConnection);
	}
}