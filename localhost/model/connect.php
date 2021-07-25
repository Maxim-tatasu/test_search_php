<?php
Class Search
{

   public $connect;
   public $searc;

   public function __construct(){
       
    }

    
    public function Download2(){
        $files=['../posts.json','../comments.json'];
        $links=['https://jsonplaceholder.typicode.com/posts','https://jsonplaceholder.typicode.com/comments'];
        for( $i=0 ; $i<2 ; $i++ ){
            copy($links[$i],$files[$i]);
        }
            $string0 = file_get_contents($files[0]);
            $string1 = file_get_contents($files[1]);
            // Превращаем строку в объект
            $data0 = json_decode($string0);
            $data1 = json_decode($string1);
            // Отлавливаем ошибки возникшие при превращении
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                     $data_error = '';
                    break;
                case JSON_ERROR_DEPTH:
                     $data_error = 'Достигнута максимальная глубина стека';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                     $data_error = 'Неверный или не корректный JSON';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                     $data_error = 'Ошибка управляющего символа, возможно верная кодировка';
                    break;
                case JSON_ERROR_SYNTAX:
                     $data_error = 'Синтаксическая ошибка';
                    break;
                case JSON_ERROR_UTF8:
                     $data_error = 'Некорректные символы UTF-8, возможно неверная кодировка';
                    break;  
                    default:
                       $data_error = 'Неизвестная ошибка';
                    break;
                }
            // Если ошибки есть, то выводим их
            if($data_error !='') echo $data_error;
                // Присваиваим данные переменным
                foreach ($data0 as &$dataPosts) {
                $title = $dataPosts->title;
                $body = $dataPosts->body;
                $userId = $dataPosts->userId;
                $id = $dataPosts->id;
                $this->insert_str_post($id,$userId,$body,$title);
                }
                foreach ($data1 as &$dataComments) {
                    $body1 = $dataComments->body;
                    $name = $dataComments->name;
                    $email = $dataComments->email;
                    $postId = $dataComments->postId;
                    $id1 = $dataComments->id;
                    $this->insert_str_comment($id1,$postId,$email,$name,$body1);
                     }
                     $this->count_str();
                    
    }
    
    public function connectDB(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        return $this->connect=mysqli_connect("localhost","mysql","mysql","blog_test");
    }

    public function count_str(){
        $this->connectDB();
        $coun="SELECT 
        @post:=(SELECT count(*) FROM `posts`) AS post,
        @comme:=(SELECT count(*) FROM `comments`) AS comme";
        $result = mysqli_query($this->connectDB(),$coun );
        foreach($result as $row){
         
            $post = $row["post"];
            $comme = $row["comme"];
        }
        echo "Загружено {$post} записей и {$comme} комментариев";
    }
    
    public function insert_str_post($id,$userId,$body,$title){
       
        if ($this->connectDB()){

            
            $query="INSERT INTO `posts`(`id`,`userid`, `title`, `body`) VALUES ($id,$userId,'$body','$title');";
            
            
            $result = mysqli_query($this->connectDB(),$query );
            
            
        }else{
            return $err="Error not connection";
        }
    }

    public function insert_str_comment($id1,$postId,$email,$name,$body1){
       
        if ($this->connectDB()){

            
            $query="INSERT INTO `comments`(`id`,`postid`,  `name`, `email`, `body`) VALUES($id1,$postId,'$name','$email','$body1');";
            
            
            $result = mysqli_query($this->connectDB(),$query );
            
            
        }else{
            return $err="Error not connection";
        }
    }

   public function serach_str($sear){
       
        $this->connectDB();

            $query="SELECT posts.title as title, posts.body as body_post, comments.body as body_comment FROM comments, posts WHERE comments.body LIKE '%{$sear}%';";
            $result = mysqli_query($this->connectDB(),$query );
            
            include_once "../view/result_search.php";
        
    }
}

?>
