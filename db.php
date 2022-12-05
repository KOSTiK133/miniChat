<?php
class DB
{

    //const server = ;
    const port = 3306;
    const nameDB = "chat";
    const dbuser = "root";
    const dbpassword = "root";


    public function connection(){
        return mysqli_connect("127.0.0.1","root", "root", "chat",3306);
    }
    public function SelectData($query){
        $data=[];
        $connection = $this->connection();
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
        }
        //mysqli_close($connection);
        return $data;
    }
    public function InsertData($query){
        $connection = $this->connection();
        $result = mysqli_query($connection, $query);
        if ($result === TRUE) {
            return $connection->insert_id;
        }
        else {
            return $connection->error;
        }
        mysqli_close($connection);

    }
}
?>
