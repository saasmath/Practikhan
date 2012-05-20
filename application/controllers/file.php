<?php
/**
 * File Class
 *
 * @package		ThinkBinder REST API
 * @subpackage	file
 * @category	file
 * @author		Dave Lee
 * @version		0.8
 * @link		http://thinkbinder.com
 *
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once (realpath(dirname(__FILE__) . "/" . "base.php"));

$mime_types = array(
	'ai'      => 'application/postscript',
	'aif'     => 'audio/x-aiff',
	'aifc'    => 'audio/x-aiff',
	'aiff'    => 'audio/x-aiff',
	'asc'     => 'text/plain',
	'atom'    => 'application/atom+xml',
	'atom'    => 'application/atom+xml',
	'au'      => 'audio/basic',
	'avi'     => 'video/x-msvideo',
	'bcpio'   => 'application/x-bcpio',
	'bin'     => 'application/octet-stream',
	'bmp'     => 'image/bmp',
	'cdf'     => 'application/x-netcdf',
	'cgm'     => 'image/cgm',
	'class'   => 'application/octet-stream',
	'cpio'    => 'application/x-cpio',
	'cpt'     => 'application/mac-compactpro',
	'csh'     => 'application/x-csh',
	'css'     => 'text/css',
	'csv'     => 'text/csv',
	'dcr'     => 'application/x-director',
	'dir'     => 'application/x-director',
	'djv'     => 'image/vnd.djvu',
	'djvu'    => 'image/vnd.djvu',
	'dll'     => 'application/octet-stream',
	'dmg'     => 'application/octet-stream',
	'dms'     => 'application/octet-stream',
	'doc'     => 'application/msword',
	'dtd'     => 'application/xml-dtd',
	'dvi'     => 'application/x-dvi',
	'dxr'     => 'application/x-director',
	'eps'     => 'application/postscript',
	'etx'     => 'text/x-setext',
	'exe'     => 'application/octet-stream',
	'ez'      => 'application/andrew-inset',
	'gif'     => 'image/gif',
	'gram'    => 'application/srgs',
	'grxml'   => 'application/srgs+xml',
	'gtar'    => 'application/x-gtar',
	'hdf'     => 'application/x-hdf',
	'hqx'     => 'application/mac-binhex40',
	'htm'     => 'text/html',
	'html'    => 'text/html',
	'ice'     => 'x-conference/x-cooltalk',
	'ico'     => 'image/x-icon',
	'ics'     => 'text/calendar',
	'ief'     => 'image/ief',
	'ifb'     => 'text/calendar',
	'iges'    => 'model/iges',
	'igs'     => 'model/iges',
	'jpe'     => 'image/jpeg',
	'jpeg'    => 'image/jpeg',
	'jpg'     => 'image/jpeg',
	'js'      => 'application/x-javascript',
	'json'    => 'application/json',
	'kar'     => 'audio/midi',
	'latex'   => 'application/x-latex',
	'lha'     => 'application/octet-stream',
	'lzh'     => 'application/octet-stream',
	'm3u'     => 'audio/x-mpegurl',
	'man'     => 'application/x-troff-man',
	'mathml'  => 'application/mathml+xml',
	'me'      => 'application/x-troff-me',
	'mesh'    => 'model/mesh',
	'mid'     => 'audio/midi',
	'midi'    => 'audio/midi',
	'mif'     => 'application/vnd.mif',
	'mov'     => 'video/quicktime',
	'movie'   => 'video/x-sgi-movie',
	'mp2'     => 'audio/mpeg',
	'mp3'     => 'audio/mpeg',
	'mpe'     => 'video/mpeg',
	'mpeg'    => 'video/mpeg',
	'mpg'     => 'video/mpeg',
	'mpga'    => 'audio/mpeg',
	'ms'      => 'application/x-troff-ms',
	'msh'     => 'model/mesh',
	'mxu'     => 'video/vnd.mpegurl',
	'nc'      => 'application/x-netcdf',
	'oda'     => 'application/oda',
	'ogg'     => 'application/ogg',
	'pbm'     => 'image/x-portable-bitmap',
	'pdb'     => 'chemical/x-pdb',
	'pdf'     => 'application/pdf',
	'pgm'     => 'image/x-portable-graymap',
	'pgn'     => 'application/x-chess-pgn',
	'png'     => 'image/png',
	'pnm'     => 'image/x-portable-anymap',
	'ppm'     => 'image/x-portable-pixmap',
	'ppt'     => 'application/vnd.ms-powerpoint',
	'ps'      => 'application/postscript',
	'qt'      => 'video/quicktime',
	'ra'      => 'audio/x-pn-realaudio',
	'ram'     => 'audio/x-pn-realaudio',
	'ras'     => 'image/x-cmu-raster',
	'rdf'     => 'application/rdf+xml',
	'rgb'     => 'image/x-rgb',
	'rm'      => 'application/vnd.rn-realmedia',
	'roff'    => 'application/x-troff',
	'rss'     => 'application/rss+xml',
	'rtf'     => 'text/rtf',
	'rtx'     => 'text/richtext',
	'sgm'     => 'text/sgml',
	'sgml'    => 'text/sgml',
	'sh'      => 'application/x-sh',
	'shar'    => 'application/x-shar',
	'silo'    => 'model/mesh',
	'sit'     => 'application/x-stuffit',
	'skd'     => 'application/x-koan',
	'skm'     => 'application/x-koan',
	'skp'     => 'application/x-koan',
	'skt'     => 'application/x-koan',
	'smi'     => 'application/smil',
	'smil'    => 'application/smil',
	'snd'     => 'audio/basic',
	'so'      => 'application/octet-stream',
	'spl'     => 'application/x-futuresplash',
	'src'     => 'application/x-wais-source',
	'sv4cpio' => 'application/x-sv4cpio',
	'sv4crc'  => 'application/x-sv4crc',
	'svg'     => 'image/svg+xml',
	'svgz'    => 'image/svg+xml',
	'swf'     => 'application/x-shockwave-flash',
	't'       => 'application/x-troff',
	'tar'     => 'application/x-tar',
	'tcl'     => 'application/x-tcl',
	'tex'     => 'application/x-tex',
	'texi'    => 'application/x-texinfo',
	'texinfo' => 'application/x-texinfo',
	'tif'     => 'image/tiff',
	'tiff'    => 'image/tiff',
	'tr'      => 'application/x-troff',
	'tsv'     => 'text/tab-separated-values',
	'txt'     => 'text/plain',
	'ustar'   => 'application/x-ustar',
	'vcd'     => 'application/x-cdlink',
	'vrml'    => 'model/vrml',
	'vxml'    => 'application/voicexml+xml',
	'wav'     => 'audio/x-wav',
	'wbmp'    => 'image/vnd.wap.wbmp',
	'wbxml'   => 'application/vnd.wap.wbxml',
	'wml'     => 'text/vnd.wap.wml',
	'wmlc'    => 'application/vnd.wap.wmlc',
	'wmls'    => 'text/vnd.wap.wmlscript',
	'wmlsc'   => 'application/vnd.wap.wmlscriptc',
	'wrl'     => 'model/vrml',
	'xbm'     => 'image/x-xbitmap',
	'xht'     => 'application/xhtml+xml',
	'xhtml'   => 'application/xhtml+xml',
	'xls'     => 'application/vnd.ms-excel',
	'xml'     => 'application/xml',
	'xpm'     => 'image/x-xpixmap',
	'xsl'     => 'application/xml',
	'xslt'    => 'application/xslt+xml',
	'xul'     => 'application/vnd.mozilla.xul+xml',
	'xwd'     => 'image/x-xwindowdump',
	'xyz'     => 'chemical/x-xyz',
	'zip'     => 'application/zip'
);




class File extends Base {


    function __construct() {
        parent::__construct();
		$this->load->model('File_model');
		$this->load->library('Validate');
		$this->v =& $this->validate;
	}
	
	
	function browse() {
		$uid = $this->person_data['id'];
		$mid = $this->input->post('motif');
		
		if (!$this->v->run($mid, 'id')) {
			$this->message('Input error',-1);
			return;
		}
		
		$club = $this->File_model->getOne('clubs', array('motif'=>$mid));
		if (!$club) {
			$this->message('Club not found', -2);
			return;
		}

		// do we have permission
		if (!$this->in_club($uid,$club->id)) {
			$this->message('You do not have access to this group.', -3);
			return;
		}

		$where = array(
			'motif' => $mid,
			'active' => 1
		);
		$motif_files = $this->File_model->get('files', $where, null, 'id DESC');
		$num = (empty($motif_files) ? 0 : count($motif_files));

		if ($num) {
			foreach ($motif_files AS &$f) {
				$f->date = date('M j, g:i A', strtotime($f->created));
			}
		}
		
		$result = array(
			'motif_files'	=> $motif_files
		);
		$this->response($num, $result);

		$this->addLog($uid, 'browse', $club->id);
	}
	
	
	
	
	/**
	 * handle user file upload
	 *
	 * downloads file to server, adds entry to db
	 * images get downconverted to manageable sizes
	 * transfer everything to AWS cloud
	 *
	 * @param file			file to upload
	 * @param string type	client defined identifier string
	 * @param string id		client defined id
	 */
	function upload() {
		$uid = $this->person_data['id'];

		$allowed_types = array(
			'doc|docx|text|txt|ppt|pps|eps|rtf|csv|pdf|xls|xlsx|ttf',
			'mov|wmv|wma|m4v|divx|avi|mp4|mpg|mpeg|3gp|3g2|3gpp',
			'mp2|mp3|wav|mid|m4p|m4a|m4b',
			'zip|rar|sitx|sit|tar|tgz',
			'dwg|cad|cdl|mcd',
			'png|jpeg|jpg|gif|png|eps'
		);
		
		$upload_dir = $this->config->item('dropbox');
		$config['upload_path'] = $upload_dir;
		$config['allowed_types'] = join('|',$allowed_types);
		$config['max_size']	= '3100';
		$config['max_width']  = '3072';
		$config['max_height']  = '3072';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		
		$type = $this->input->post('type');
		$refID = $this->input->post('id');
		$mid = $this->input->post('motif');

		if (!$refID) $refID = 0;
		
		if ( ! $this->upload->do_upload() ) {
			$errors = $this->upload->display_errors();
			$errors = preg_replace('/<.+?>/', '', $errors);
    		$this->addLog($uid, 'uploaderror', 'file', $errors, 'fail');
			$script = '<script type="text/javascript">window.parent.window.BinderUploader.callback(-1,"'.$errors.'",0,'.$refID.',"'.$type.'");</script>';
			$this->output->set_output( $script );
			return;
		}
		else {
			// get file information
			$data = $this->upload->data();
			$file_name = $data['file_name'];
			$file_type = $data['file_type'];
			$file_path = $data['file_path'];
			$full_path = $data['full_path'];
			$raw_name = $data['raw_name'];
			$orig_name = $data['orig_name'];
			$client_name = $data['client_name'];
			$file_ext = $data['file_ext'];
			$file_size = $data['file_size'];
			$is_image = $data['is_image'];
			$image_width = $data['image_width'];
			$image_height = $data['image_height'];
			$image_type = $data['image_type'];
			
			$filetype = 'file';
			if ($is_image) $filetype = $image_type;
			
			$file_id = $this->File_model->addFile($uid,$orig_name,$file_ext,$full_path,$filetype,$file_size,$is_image);
			if(! $file_id) {
				$script = "<script type='text/javascript'>parent.BinderUploader.callback(-2,'There was an error uploading your file, please try again.',0,$refID,'$type');</script>";
				$this->output->set_output( $script );
				return;
			}

			$previewAddress = '';

			// what group was this posted in?
			if ($mid) $this->File_model->update('file', 'motif', $mid, $file_id);	
			
			// was it an image?
			if ($is_image) {
				$previewAddress = $this->processImage($file_id, $data);
			}
			else {
				$address = $this->moveToCloud($orig_name,$full_path,0);
				if ($address) $this->File_model->update('file','address',$address,$file_id);	
			}
			
			$script = "<script type='text/javascript'>window.top.window.BinderUploader.callback(1,eval(".json_encode($data)."),$file_id,$refID,'$type','$previewAddress');</script>";
			$this->output->set_output( $script );
			$this->addLog($uid, 'upload', 'file', $file_id);
		}
	}
	
	
	
	
	/**
	 *	processImage - convert images to smaller sizes
	 *
	 * @access	public
	 * @param	file_id
	 * @param	data
	 * @return	string
	 */
	function processImage($file_id,$data) {
		$upload_dir = $this->config->item('dropbox');
		
		// add dimension info to db entry
		$width = $data['image_width'];
		$height = $data['image_height'];
		$this->File_model->update('file', 'dimensions', "$width x $height", $file_id);
		
		$raw_path = '';
		$thumbnail_path = '';
		$previewAddress = '';
		$bigview_path = '';

		// downsize images to manageable sizes
		$raw_path = $data['full_path'];
		$thumbnail_path = $upload_dir . '/' . $data['raw_name'] . '.thumbnail' . $data['file_ext'];
		$preview_path = $upload_dir . '/' . $data['raw_name'] . '.preview' . $data['file_ext'];
		$bigview_path = $upload_dir . '/' . $data['raw_name'] . '.large' . $data['file_ext'];
		
		if ($width > 50 || $height > 50) {
			if ($data['file_ext'] == '.gif')
				$output = exec("gifsicle --resize 50x50 --output $thumbnail_path $raw_path");			
			else
				$output = exec("/usr/bin/convert $raw_path -resize 50x50 $thumbnail_path");			
		}
		if ($width > 180 || $height > 180) {
			if ($data['file_ext'] == '.gif')
				$output = exec("gifsicle --resize 180x180 --output $preview_path $raw_path");			
			else
				$output = exec("/usr/bin/convert $raw_path -resize 180x180 $preview_path");
		}
		if ($width > 800 || $height > 600) {
			if ($data['file_ext'] == '.gif')
				$output = exec("gifsicle --resize 800x600 --output $bigview_path $raw_path");			
			else
				$output = exec("/usr/bin/convert $raw_path -resize 800x600 $bigview_path");
		}

		// push images to the cloud
		$address = $this->moveToCloud($data['orig_name'], $data['full_path'], 1);
		if ($address) $this->File_model->update('file', 'address', $address, $file_id);
			
		$thumbaddress = $this->moveToCloud($data['orig_name'], $thumbnail_path, 1, $data['full_path']);		
		$previewaddress = $this->moveToCloud($data['orig_name'], $preview_path, 1, $data['full_path']);
		$bigviewaddress = $this->moveToCloud($data['orig_name'], $bigview_path, 1, $data['full_path']);
		
		if ($thumbaddress || $previewaddress || $bigviewaddress) {
			$addresskey = 'http://download.thinkbinder.com/images/'.$data['raw_name'] . '.ineedtobereplaced' . $data['file_ext'];
			$this->File_model->update('file', 'address_key', $addresskey, $file_id);
		}
		
		return $previewaddress;
	}
	
	
	
	
	/**
	 *	processImage - convert images to smaller sizes
	 *
	 * @access	public
	 * @param	file_id
	 * @param	data
	 * @return	string
	 */
	function moveToCloud($filename,$filepath,$is_image=0,$fallback=null) {
		//include_once (realpath(dirname(__FILE__) . "/" . "aws/S3.php"));
		if (!class_exists('S3')) require_once (realpath(dirname(__FILE__) . "/../libraries/" . "aws/S3.php"));
		
		// AWS access info
		if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJU4PFUCPPNTBFJRA');
		if (!defined('awsSecretKey')) define('awsSecretKey', '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');
		
		$uploadFile = $filepath; // File to upload, we'll use the S3 class since it exists
		$bucketName = 'download.thinkbinder.com';
		
		// If you want to use PECL Fileinfo for MIME types:
		//if (!extension_loaded('fileinfo') && @dl('fileinfo.so')) $_ENV['MAGIC'] = '/usr/share/file/magic';
		$uploadFolder = ($is_image ? 'images/' : 'documents/');
		
		// Check if our upload file exists
		if (!file_exists($uploadFile) || !is_file($uploadFile)) {
			//exit("\nERROR: No such file: $uploadFile\n\n");
			if (!$fallback) return;
			$uploadFile = $fallback;
		}
		
		// Check for CURL
		if (!extension_loaded('curl') && !@dl(PHP_SHLIB_SUFFIX == 'so' ? 'curl.so' : 'php_curl.dll'))
			exit("\nERROR: CURL extension not loaded\n\n");
		
		// Instantiate the class
		$s3 = new S3(awsAccessKey, awsSecretKey);
		
		// set MIME content type
		// maybe later, do we want to force a download or allow browser to handle file in its own way?
		
		// Put our file (also with public read access)
		$filename = urlencode($filename);
		if ($s3->putObjectFile($uploadFile, $bucketName, $uploadFolder.baseName($filepath), S3::ACL_PUBLIC_READ,array(), array("Content-Type" => "application/octet-stream", "Content-Disposition" => "attachment; filename=${filename}"))) {
			#echo "S3::putObjectFile(): File copied to {$bucketName}/".baseName($uploadFile).PHP_EOL;
			return 'http://download.thinkbinder.com/'.$uploadFolder.baseName($filepath);
		}
		return -1;
	}




	/**
	 *	processImage - convert images to smaller sizes
	 *
	 * @access	public
	 * @param	file_id
	 * @param	data
	 * @return	string
	 */
	function save() {
		$uid = $this->person_data['id'];
		$fid = $this->input->post('file');
		$cid = $this->input->post('club');
		
		if (!$this->v->run($fid, 'id') || !$this->v->run($cid, 'id')) {
			$this->message('error');
			return;
		}
		
		$file = $this->File_model->getOne('file', array('id'=>$fid));
		if (!$file) {
			$this->addLog($uid, 'nofile', 'file', $fid, 'error');
			$this->message('fail');
			return;
		}

		$club = $this->File_model->getOne('clubs', array('id'=>$cid));
		if (!$club) {
			$this->addLog($uid, 'noclub', 'file', $cid, 'error');
			$this->message('fail');
			return;
		}

		$where = array(
			'user' => $uid,
			'status' => 'active',
			'club' => $cid
		);
		$membership = $this->File_model->getOne('memberships', $where);
		if (!$membership) {
			$this->message('Study group membership not found!', -1);
			return;			
		}

		// add new post
		$this->load->model('Publish_model');
		$username = $this->person_data['firstname'] . ' ' . $this->person_data['lastname'];
		$post_id = $this->Publish_model->post("$username has uploaded a new file", $uid, $club->motif, $cid);
		if (!$post_id) {
			$this->message('There was an error on our servers publishing to the news feed.', 0);
			return;
		}

		$this->Publish_model->update('post', 'tag1', 'file', $post_id);
		$this->Publish_model->update('post', 'file', $fid, $post_id);
		$this->Publish_model->update('post', 'type', 'file', $post_id);
		$this->Publish_model->update('file', 'motif', $club->motif, $fid);
		$this->Publish_model->update('file', 'active', 1, $fid);
		
		$this->load->library('notify');
		$this->notify->post($post_id);

		$this->addLog($uid, 'save', 'file', $fid);

		$this->message($fid,$fid);
	}




	/**
	 *	processImage - convert images to smaller sizes
	 *
	 * @access	public
	 * @param	file_id
	 * @param	data
	 * @return	string
	 */
	function saveProfilePic() {
		$uid = $this->person_data['id'];
		$file = $this->input->post('file');
		
		if (!$this->v->run($file, 'id')) {
			$this->message('error');
			return;
		}
		
		$pic = $this->File_model->getOne('file', array('id'=>$file));
		if (!$pic) {
			$this->addLog($uid, 'nopic', 'account', $file, 'error');
			$this->message('fail');
			return;
		}

		$thumbnail = preg_replace('/ineedtobereplaced/', 'thumbnail', $pic->address_key);
		$this->File_model->update('user', 'pictureURL', $thumbnail, $uid);			

		$this->addLog($uid, 'pic', 'account', $file);

		$result = array(
			'pictureURL' => $pic->address,
		);
		$this->session->set_userdata($result);
		$this->response($pic->id,$result);
	}
	
	
	
	
	function remove() {
		$uid = $this->person_data['id'];
		$fid = $this->input->post('file');
		
		if (!$this->v->run($fid, 'id')) {
			$this->message('error', -1);
			return;
		}
		
		$where = array(
			'id' => $fid,
			'user' => $uid
		);
		$file = $this->File_model->getOne('file', $where);
		if (!$file) {
			$this->addLog($uid, 'nofile', 'file', $fid, 'error');
			$this->message('File not found', -1);
			return;
		}
		
		$canvas = $this->File_model->getOne('revision', array('file'=>$fid));
		if ($canvas) {
			$this->load->model('Canvas_model');
		    $this->Canvas_model->delete($canvas->id);
		}

		$post = $this->File_model->remove($fid);
		
		$result = array(
			'file' => $fid,
			'post' => $post,
			'message' => 'File deleted'
		);
		$this->response($fid, $result);

		$this->addLog($uid, 'delete', 'file', $fid);
	}
	
	
}