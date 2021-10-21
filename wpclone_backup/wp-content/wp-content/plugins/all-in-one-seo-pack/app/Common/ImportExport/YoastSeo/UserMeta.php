<?php
namespace AIOSEO\Plugin\Common\ImportExport\YoastSeo;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use AIOSEO\Plugin\Common\ImportExport;
use AIOSEO\Plugin\Common\Models;

// phpcs:disable WordPress.Arrays.ArrayDeclarationSpacing.AssociativeArrayFound

/**
 * Imports the user meta from Yoast SEO.
 *
 * @since 4.0.0
 */
class UserMeta {
	/**
	 * Class constructor.
	 *
	 * @since 4.0.0
	 */
	public function scheduleImport() {
		aioseo()->helpers->scheduleSingleAction( aioseo()->importExport->yoastSeo->userActionName, 30 );

		if ( ! aioseo()->transients->get( 'import_user_meta_yoast_seo' ) ) {
			aioseo()->transients->update( 'import_user_meta_yoast_seo', 0, WEEK_IN_SECONDS );
		}
	}

	/**
	 * Imports the post meta.
	 *
	 * @since 4.0.0
	 *
	 * @return void
	 */
	public function importUserMeta() {
		$usersPerAction = 100;
		$offset         = aioseo()->transients->get( 'import_user_meta_yoast_seo' );

		$usersMeta = aioseo()->db
			->start( 'usermeta' . ' as um' )
			->whereRaw( "um.meta_key IN ('facebook', 'twitter')" )
			->whereRaw( "um.meta_value != ''" )
			->limit( $offset . ',' . $usersPerAction )
			->run()
			->result();

		if ( ! $usersMeta || ! count( $usersMeta ) ) {
			aioseo()->transients->delete( 'import_user_meta_yoast_seo' );
			return;
		}

		foreach ( $usersMeta as $meta ) {
			update_user_meta( $meta->user_id, 'aioseo_' . $meta->meta_key, $meta->meta_value );
		}

		if ( count( $usersMeta ) === $usersPerAction ) {
			aioseo()->transients->update( 'import_user_meta_yoast_seo', 100 + $offset, WEEK_IN_SECONDS );
			aioseo()->helpers->scheduleSingleAction( aioseo()->importExport->yoastSeo->userActionName, 5 );
		} else {
			aioseo()->transients->delete( 'import_user_meta_yoast_seo' );
		}
	}
}