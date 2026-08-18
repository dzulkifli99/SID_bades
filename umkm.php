<?php
/**
 * Controller — Etalase UMKM Publik
 * Model : app/models/UmkmModel.php
 * View  : app/views/umkm/umkm_view.php
 */
session_start();
include "koneksi.php";
require_once "app/models/UmkmModel.php";

$umkm_data = umkm_get_all($koneksi);

require "app/views/umkm/umkm_view.php";
