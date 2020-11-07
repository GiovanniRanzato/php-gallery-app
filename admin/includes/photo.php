<?php


class Photo extends Db_object
{
    protected static $db_table = "photos";
    protected static $db_table_fields = array("title","caption","description","filename","alternate_text","type","size");
    public $id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;

    public $tmp_name;
    public $upload_directory = "images";
    public $errors = array ();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => 'There is no error, the file uploaded with success',
        UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.',
    );

    // This is passing $_FILES[uploaded_file] as an argument
    public  function set_file ($file) {
        if(empty($file) || !$file ){
            $this->errors[] = "There was no file uploaded here";
            return false;
        }elseif( $file['error'] != 0 ){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            $this->filename = basename($file['name']); // basename escape file name
            $this->tmp_name = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }

    }

    public function picture_path (){
        return $this->upload_directory.DS.$this->filename;
    }

    public function save(){
        if($this->id){
            $this->update();
        }else{
            // Errors handling
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->filename) ||  empty($this->tmp_name) ){
                $this->errors[] = "No file name or temporary path found!";
                return false;
            }
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS .$this->filename;
            if(file_exists($target_path)){
                $this->errors[] = "The file {$this->filename} already exist!";
                return false;
            }
            // Uploading file
            if( move_uploaded_file($this->tmp_name, $target_path) ){
                if($this->create()){
                    unset($this->tmp_name);
                    return true;
                }
            }else{
                $this->errors[] = "A unexpected error occured while uploading the file... try to check directory permission.";
                return false;
            }
        }
    }
    // Delete the photo from database
    // Delte the photo from the server
    public function delete_photo (){
        if($this->delete() ){
            $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
            return unlink($target_path) ? true : false;
        }else{
            return false;
        }

    }

 
}// End Photo