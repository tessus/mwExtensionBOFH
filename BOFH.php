<?php
if ( function_exists( 'wfLoadExtension' ) ) {
    wfLoadExtension( 'BOFH' );
    wfWarn(
        'Deprecated PHP entry point used for the FooBar extension. ' .
        'Please use wfLoadExtension instead, ' .
        'see https://www.mediawiki.org/wiki/Extension_registration for more details.'
    );
    return;
} else {
    die( 'This version of the FooBar extension requires MediaWiki 1.25+' );
}
