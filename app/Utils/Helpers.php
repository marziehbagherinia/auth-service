<?php

if ( !function_exists( 'config_path' ) )
{
    /**
     * Return path
     *
     * @param string $path
     * @return string
     */
	function config_path( string $path = '' ): string
    {
		return app()->basePath() . '/config' . ( $path ? '/' . $path : $path );
	}
}
