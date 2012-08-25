<?php
/**
* TwitchTV API
*
* SDK for interacting with the TwitchTV API.
*
* @author Darren Taylor <shout@darrenonthe.net>
* https://github.com/dtisgodsson/twitch.tv-php-sdk
*/
class TwitchTV
{

	private static $base_url = "https://api.twitch.tv/kraken/";

	public static function get_user( $username )
	{
		return static::_request( TwitchTV_Endpoints::GET_USER . $username );
	}

	public static function get_channel( $channel )
	{
		return static::_request( TwitchTV_Endpoints::GET_CHANNEL . $channel );
	}

	public static function get_stream( $channel )
	{
		return static::_request( TwitchTV_Endpoints::GET_STREAM . $channel );	
	}

	public static function get_featured_streams( $limit = null, $offset = null )
	{
		$query_string = static::_build_query_string( array( "limit" => $limit, "offset" => $offset ) );
		return static::_request( TwitchTV_Endpoints::GET_FEATURED_STREAMS . $query_string );		
	}

	public static function get_streams_by_game( $game, $limit = null, $offset = null )
	{
		return static::get_streams( $game, $limit, $offset );
	}

	public static function get_streams_by_channel( $channels, $limit = null, $offset = null )
	{
		$channels = is_array( $channels ) ? $channels : (array) $channels;
		return static::get_streams( null, $limit, $offset, $channels );
	}

	public static function get_top_games( $limit = null, $offset = null )
	{
		$query_string = static::_build_query_string( array( "limit" => $limit, "offset" => $offset ) );
		return static::_request( TwitchTV_Endpoints::GET_TOP_GAMES . $query_string );
	}

	public static function search_streams( $query, $limit = null, $offset = null )
	{
		$query_string = static::_build_query_string( array( "query" => $query, "limit" => $limit, "offset" => $offset ) );
		return static::_request( TwitchTV_Endpoints::SEARCH_STREAMS . $query_string );
	}

	private static function get_streams( $game = null, $limit = null, $offset = null, $channels = array() )
	{
		$params = array(
			"game" 		=> $game,
			"limit" 	=> $limit,
			"offset" 	=> $offset,
			"channel" 	=> !empty( $channels ) ? implode( ",", $channels ) : null
		);

		$query_string = static::_build_query_string( $params );

		return static::_request( TwitchTV_Endpoints::GET_STREAM . $query_string );
	}

	private static function _build_query_string( $params )
	{
		$param = array();
		$query_string = "";

		foreach( $params as $key => $value )
		{
			if( !empty( $value ) )
			{
				$param[$key] = $value;
			}
		}

		if( !empty( $params ) )
		{
			$query_string = "?" . http_build_query( $params );
		}

		return $query_string;
	}

	private static function _request( $url )
	{
		$curl = curl_init();

		curl_setopt( $curl, CURLOPT_URL, static::$base_url . $url );
		curl_setopt( $curl, CURLOPT_HEADER, 0 );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, TRUE); 
		curl_setopt( $curl, CURLOPT_CAINFO, "cacert.pem");
		curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'GET');	

		return json_decode( curl_exec( $curl ) );
	}

}

class TwitchTV_Endpoints
{
	const GET_USER 				= "users/";
	const GET_STREAM 			= "streams/";
	const GET_FEATURED_STREAMS 	= "streams/featured/";
	const GET_CHANNEL 			= "channels/";
	const GET_TOP_GAMES			= "games/top/";
	const SEARCH_STREAMS		= "search/streams/";
}