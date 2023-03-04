<?php
    class NoteController extends AutoLoader {
        private NoteModel $noteModel;
        
        public function __construct() {
            $this->noteModel = $this->model('NoteModel');
        }
        // Call get note function 
        public function index() {
            if(isset($_SESSION['userId'])) {
                $data = [];
                $this->getNotesCon();
            } else {
                $this->view('pages/login', $data = []);
            }
        }

        // Get notes from user by id from the db
        public function getNotesCon() {
            $notes =  $this->noteModel->getNotesModel((int)$_SESSION['userId']);
            $data = ['notes' => $notes, 'errorMess' => '']; 
            $this->view('/pages/note', $data);
        }

        private function emptyData() {
            $data = ['notes' => array('userId' => '', 'noteId' => '', 'textContent' => '', 'colorId' => '', 'createStamp' => ''), 'errorMess' => ''];
            return $data;
        }

        // Update note by id
        public function updateNoteCon() {
            $data = $this->emptyData();
            if (isset($_GET['action'])) {
                if($_GET['action'] === '_UPDATE') {
                    if(empty($_GET['textContent'])) {
                        $data['errorMess'] = "Please enter some content in the note to be saved.";
                    } else {
                        $_GET['textContent'] = $this->filterString($_GET['textContent']);
                        if($_GET['textContent']=== false) {
                            $data['errorMess'] = "Please enter valid content in the note.";
                        } else {
                            $data['noteId'] = trim($_GET['noteId']);
                            $data['textContent'] = trim($_GET['textContent']);
                            $data['colorId'] = $_GET['colorId'];
                            $tempUpdate = $this->noteModel->updateNoteModel($data['noteId'], $data['textContent'], $data['colorId']);
                            if($tempUpdate) {
                            $data['errorMess'] = "The note is saved.";
                            } else {
                            $data['errorMess'] = 'Something went wrong, please try again.';
                            }
                        }
                    }
                }
            }

            // AJAX call in JS
            $this->reloadPage($data);
        }

        // Delete note by id
        public function deleteNoteCon() {
            $data = $this->emptyData();
            $data['errorMess'] = ''; 
            if(isset($_GET['action']) && $_GET['action'] === '_DELETE') {
                if(empty($_GET['noteId'])) {
                    $data['errorMess'] = "The note could not been found, please refresh.";
                } 
                
                if(empty($data['errorMess'])) {
                    $id = $_GET['noteId'];
                    $tempDelete = $this->noteModel->deleteNotesModel($id);
                    if($tempDelete === true) {
                        $data['errorMess'] = "The note is deleted.";
                    } else {
                        $data['errorMess'] = "Something went wrong please try again.";
                    }
                }
            }

            // AJAX call in JS
            $this->reloadPage($data);
        }

        // Create note
        public function createNoteCon() {
            $data = $this->emptyData();
            $data['errorMess'] = '';
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(empty($_POST['textContent'])) {
                    $data['errorMess'] = "Please enter some content in the note.";
                }
                
                $_POST['textContent'] = $this->filterString($_POST['textContent']);
                if($_POST['textContent']=== false) {
                    $data['errorMess'] = "Please enter valid content in the note.";
                } 

                if(empty($data['errorMess'])) {
                    $data['textContent'] = trim($_POST['textContent']);
                    $data['userId'] = $_SESSION['userId'];
                    $data['colorId'] = $_POST['colorId'];
                    $tempNote = $this->noteModel->createNoteModel($data['userId'], $data['textContent'], $data['colorId']);
                    if($tempNote === true) {
                        $data['errorMess'] = 'The note has been created.';
                    } else {
                        $data['errorMess'] = 'Something went wrong, please try again.';
                    }
                }
            }
            // AJAX call in JS
            $this->reloadPage($data);
        }
        
        // Reopen page deprecated after AJAX call
        private function reloadPage($data) {
            $tempErrorMess = $data['errorMess'];
            $notes =  $this->noteModel->getNotesModel($_SESSION['userId']);
            $data = ['notes' => $notes, 'errorMess' => $tempErrorMess]; 
            $this->view('/pages/note', $data);
        }
    }