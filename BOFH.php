<?php
/**
 * BOFH MediaWiki extension.
 *
 * This extension adds a <bofh/> tag to display a random BOFH excuse
 *
 * Written by Helmut K. C. Tessarek
 * https://github.com/tessus/mwExtensionBOFH
 *
 * Sample template for displaying the BOFH excuse in a nostalgic look:
 * 
 * Template:BOFH 
 *
 * <table border="4" width="{{{1|600}}}" cellspacing="0" cellpadding="10" bgcolor="#000000">
 * <td><font color="#00ff40">
 * <bofh/>
 * </font></td>
 * </table>
 *
 */
 
if( !defined( 'MEDIAWIKI' ) ) 
{
	die( 'This file is a MediaWiki extension, it is not a valid entry point' );
}
 
$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'BOFH',
	'author' => 'Helmut K. C. Tessarek',
	'url' => 'https://github.com/tessus/mwExtensionBOFH',
	'description' => 'Adds a <nowiki><bofh/></nowiki> tag to display a random BOFH excuse',
	'version' => '1.0'
);
 
$wgExtensionFunctions[] = "BOFH::bofhExcuse";
 
class BOFH
{
	public static function bofhExcuse() 
	{
		global $wgParser;
		$wgParser->setHook("bofh", "BOFH::renderBOFH");
	}
 
	public static function renderBOFH( $input, $params, $parser ) 
	{
		$parser->disableCache();

		$dir = dirname( __FILE__ );

		$excuses = file("$dir/excuses.txt", FILE_IGNORE_NEW_LINES);
		mt_srand((double) microtime() * 1000000);
		$today = mt_rand(0, count($excuses)-1);

		$output = $parser->recursiveTagParse($excuses[$today]);
		return $output;
	}
}
?>
