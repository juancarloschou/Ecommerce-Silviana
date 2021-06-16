/*!
 * feed-list.js v1.1
 * Part of the WP Product Feed Manager
 * Copyright 2017, Michel Jongbloed
 *
 */

"use strict";

var $jq = jQuery.noConflict();

function wppfm_fillFeedList() {

    var feedListData = null;
    var listHtml = '';

    wppfm_getFeedList( function ( list ) {

        if ( list !== "0" ) {
			
            feedListData = JSON.parse( list );

            // convert the data to html code
            listHtml = wppfm_feedListTable( feedListData );
        }
        else {
            listHtml = wppfm_emptyListTable();
        }

        $jq( '#wppfm-feed-list' ).empty(); // first clear the feedlist

        $jq( '#wppfm-feed-list' ).append( listHtml );
    } );
}

function appendCategoryLists( channelId, language, isNew ) {
    if ( isNew ) {
        wppfm_getCategoryListsFromString( channelId, '', language, function ( categories ) {
            var list = JSON.parse( categories )[0];

            if ( list && list.length > 0 ) {
                $jq( '#lvl_0' ).html( wppfm_categorySelectCntrl( list ) );
                $jq( '#lvl_0' ).prop( 'disabled', false );
            } else {
                // as the user selected a free format, just show a text input control
                $jq( '#category-selector-lvl' ).html( wppfm_freeCategoryInputCntrl( 'default', '0', false ) );
                $jq( '#category-selector-lvl' ).prop( 'disabled', false );
            }
        } );
    }
}

function wppfm_resetFeedList() {
    wppfm_fillFeedList();
}

function wppfm_resetFeedStatus( feedData ) {
	
	wppfm_checkNextFeedInQueue( function ( feedId ) {
		if ( 'false' !== feedId && feedData['product_feed_id'] !== feedId ) {
			wppfm_updateFeedRowStatus( feedId, 3 );
		}
		
		wppfm_updateFeedRowStatus( feedData['product_feed_id'], parseInt( feedData['status_id'] ) );
		wppfm_updateFeedRowData( feedData );
	} );
}

function wppfm_feedListTable( list ) {

    var htmlCode = '';

    for ( var i = 0; i < list.length; i++ ) {

        var status = list [ i ] [ 'status' ];
//        var changeStatus = "Activate";
        var feedId = list [ i ] ['product_feed_id'];
        var feedUrl = list [ i ] ['url'];
        var feedReady = status === 'On hold' || status === 'OK' ? true : false;
        var nrProducts = '';
		
		if( feedReady ) {
			nrProducts = list [ i ] ['products'];
		} else if ( status === 'Processing' ) {
			nrProducts = 'Processing the feed, please wait...';
		} else if ( status === 'Failed processing' ) {
			nrProducts = 'Processing failed, please try again';
		}
		
//        if ( status === "OK" ) { changeStatus = "Deactivate"; }

        htmlCode += '<tr id="feed-row"';

        if ( i % 2 === 0 ) { htmlCode += ' class="alternate"'; } // alternate background color per row

        htmlCode += '>';
        htmlCode += '<td id="title">' + list [ i ] ['title'] + '</td>';
        htmlCode += '<td id="url">' + feedUrl + '</td>';
        htmlCode += '<td id="updated-' + feedId + '">' + list [ i ] ['updated'] + '</td>';
        htmlCode += '<td id="products-' + feedId + '">' + nrProducts + '</td>';
        htmlCode += '<td id="feed-status-' + feedId + '" value="' + status + '" style="color: ' + list [ i ] [ 'color' ] + '"><strong>';
//        htmlCode += feedReady ? status : 'Processing';
        htmlCode += status;
        htmlCode += '</strong></td>';
        htmlCode += '<td id="actions-' + feedId + '">';
        
        if ( feedReady ) {
            htmlCode += feedReadyActions( feedId, feedUrl, status, list [ i ] ['title'] )
        } else {
            htmlCode += feedNotReadyActions( feedId, feedUrl, list [ i ] ['title'] );
        }

        htmlCode += '</td>';
    }

    return htmlCode;
}

function feedReadyActions( feedId, feedUrl, status, title ) {
    var fileExists = feedUrl === 'No feed generated' ? false : true;
    var fileName = feedUrl.lastIndexOf( '/' ) > 0 ? feedUrl.slice( feedUrl.lastIndexOf( '/' ) - feedUrl.length + 1 ) : title;
    var changeStatus = status === 'OK' ? "Deactivated" : "Activate";
    
    var htmlCode = '<strong><a href="javascript:void(0);" onclick="parent.location=\'admin.php?page=wp-product-feed-manager-add-new-feed&id=' + feedId + '\'">Edit </a>';
    htmlCode += fileExists ? '| <a href="javascript:void(0);" onclick="wppfm_viewFeed(\'' + feedUrl + '\')">View </a>' : '';
    htmlCode += '| <a href="javascript:void(0);" onclick="wppfm_deleteSpecificFeed(' + feedId + ', \'' + fileName + '\')">Delete </a>';
    htmlCode += fileExists ? '| <a href="javascript:void(0);" onclick="wppfm_deactivateFeed(' + feedId + ')" id="feed-status-switch-' + feedId + '">' + changeStatus + ' </a>' : '';
    htmlCode += '| <a href="javascript:void(0);" onclick="wppfm_duplicateFeed(' + feedId + ', \'' + title + '\')">Duplicate </a></strong>';
    return htmlCode;
}

function feedNotReadyActions( feedId, feedUrl, title ) {
    var fileName = feedUrl.lastIndexOf( '/' ) > 0 ? feedUrl.slice( feedUrl.lastIndexOf( '/' ) - feedUrl.length + 1 ) : title;

    var htmlCode = '<strong>';
    htmlCode += '<a href="javascript:void(0);" onclick="parent.location=\'admin.php?page=wp-product-feed-manager-add-new-feed&id=' + feedId + '\'">Edit </a>';
    htmlCode += '| <a href="javascript:void(0);" onclick="wppfm_deleteSpecificFeed(' + feedId + ', \'' + fileName + '\')"> Delete</a>';
    htmlCode += '</strong>';
    htmlCode += wppfm_addFeedStatusChecker( feedId );
    return htmlCode;
}

function wppfm_emptyListTable() {

    var htmlCode = '';

    htmlCode += '<tr>';
    htmlCode += '<td colspan = 4>No data found</td>';
    htmlCode += '</tr>';

    return htmlCode;
}

function wppfm_updateFeedRowData( rowData ) {
    if ( rowData['status_id'] === '1' || rowData['status_id'] === '2' ) {
        var feedId = rowData['product_feed_id'];
        var status = rowData['status_id'] === '1' ? 'OK' : 'Other';

        $jq( '#updated-' + feedId ).html( rowData['updated'] );
        $jq( '#products-' + feedId ).html( rowData['products'] );
        $jq( '#actions-' + feedId ).html( feedReadyActions( feedId, rowData['url'], status, rowData['title'] ) );
    } else if ( rowData['status_id'] === '3' ) {
		console.log( 'Row ' + feedId + ' now has a status of ' + status );
	}
}

function wppfm_updateFeedRowStatus( feedId, status ) {
    switch( status ) {
        case 0: // unknown
            $jq( '#feed-status-' + feedId ).html( '<strong>Unknown</strong>' );
            $jq( '#feed-status-' + feedId ).css( 'color', '#6549F7' );
            $jq( '#feed-status-switch-' + feedId ).html( '' );
            break;

        case 1: // OK
            $jq( '#feed-status-' + feedId ).html( '<strong>OK</strong>' );
            $jq( '#feed-status-' + feedId ).css( 'color', '#0073AA' );
            $jq( '#feed-status-switch-' + feedId ).html( 'Deactivate' );
            break;

        case 2: // On hold
            $jq( '#feed-status-' + feedId ).html( '<strong>On hold</strong>' );
            $jq( '#feed-status-' + feedId ).css( 'color', '#0173AA' );
            $jq( '#feed-status-switch-' + feedId ).html( 'Activate' );
            break;

        case 3: // Processing
            $jq( '#feed-status-' + feedId ).html( '<strong>Processing</strong>' );
            $jq( '#feed-status-' + feedId ).css( 'color', '#0000FF' );
            $jq( '#feed-status-switch-' + feedId ).html( '' );
            $jq( '#products-' + feedId ).html( 'Processing the feed, please wait...' );
            break;

        case 4: // In queue
            $jq( '#feed-status-' + feedId ).html( '<strong>In processing queue</strong>' );
            $jq( '#feed-status-' + feedId ).css( 'color', '#00CCFF' );
            $jq( '#feed-status-switch-' + feedId ).html( 'Activate' );
            break;

        case 5: // Has errors
            $jq( '#feed-status-' + feedId ).html( '<strong>Has errors</strong>' );
            $jq( '#feed-status-' + feedId ).css( 'color', '#FF0000' );
            $jq( '#feed-status-switch-' + feedId ).html( 'Activate' );
            break;
			
		case 6: // Failed processing
            $jq( '#feed-status-' + feedId ).html( '<strong>Failed processing</strong>' );
            $jq( '#feed-status-' + feedId ).css( 'color', '#FF3300' );
            $jq( '#feed-status-switch-' + feedId ).html( '' );
            break;
    }
}

/**
 * Document ready actions
 */
jQuery( document ).ready( function () {
    // fill the items on the main admin page
    wppfm_resetFeedList();
} );
