<?php
/**
 * Gallery
 *
 * Copyright 2010 by Shaun McCormick <shaun@modx.com>
 *
 * Gallery is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Gallery is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Gallery; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gallery
 */
/**
 * @package gallery
 * @subpackage processors
 */
if (empty($scriptProperties['name'])) $modx->error->addField('name',$modx->lexicon('gallery.album_err_ns_name'));
$scriptProperties['prominent'] = !empty($scriptProperties['prominent']) ? 1 : 0;
$scriptProperties['active'] = !empty($scriptProperties['active']) ? 1 : 0;

if ($modx->error->hasError()) {
    return $modx->error->failure();
}

$album = $modx->newObject('galAlbum');
$album->fromArray($scriptProperties);
$album->set('createdby',$modx->user->get('id'));

$total = $modx->getCount('galAlbum');
$album->set('rank',$total);

if ($album->save() == false) {
    return $modx->error->failure($modx->lexicon('gallery.album_err_save'));
}

return $modx->error->success('',$album);