<?php
error_reporting(-1);

class IncludePage
{

	public static function view($getParam)
	{

		if (empty($getParam))
	    {
	        require(PATH.'/partials/browse.php'); // Default page.
	    }
	    else
	    {
	        if (file_exists(PATH.'/inc/' . $getParam . '.php') && (ctype_alpha($getParam))) // Checks if the file exist and that the get parameter only contains characters.
	        {
	            require(PATH.'/inc/' . $getParam . '.php'); // The file exist. Include and display it.
	        }
	        else 
	        {
	            require(PATH.'/inc/error.php'); // No page with that name. Include an error page.
	        }
	    }
	}
}