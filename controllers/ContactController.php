<?php
class ContactController {
    private int $id;
    private string $name;
    private string $phone;
    private array $contacts=[];

    public function __construct(?int $id,?string $name,?string $phone) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
    }
    public function index() {
        $this->getFile();
        $contacts = $this->contacts; 
        include('views/index.php');
    }
    
    public function add() {
        include('views/add.php');
    }

    public function store($name,$phone) {
        $name = $this->clean($name);
        $phone = $this->clean($phone);
        $this->getFile();
        $id = count($this->contacts)+1;
        $contact = [
            'id' => $id,
            'name' => $name,
            'phone' => $phone
        ];
        $this->contacts[] = $contact;
        $this->save();
        $_SESSION['message']="Успешно добавлено!";
        header("Location: index.php");
    }
    
    public function edit() {
        $id = $this->id;
        include('views/edit.php');
    }
    
    public function update($id,$name,$phone) {
        $id = $this->clean($id);
        $name = $this->clean($name);
        $phone = $this->clean($phone);
        $this->getFile();
        foreach($this->contacts as $key=>$value) {
            
            if(array_search($id,$value)) {
                $this->contacts[$key] = [
                    'id' => $id,
                    'name' => $name,
                    'phone' => $phone
                ];
              
            }
        }
        $this->save();
        $_SESSION['message']="Успешно редактировано!";
        header("Location: index.php");

    }

    public function delete() {
        $this->getFile();
        foreach ($this->contacts as $key => $contact) {
            if ($contact['id'] == $this->id) {
                unset($this->contacts[$key]);
            }
        }
        $this->save();
        $_SESSION['message_del']="Успешно удалено!";
        header("Location: index.php");
        
    }

    public function save() {
        file_put_contents('storage/contacts.json', json_encode(array_values($this->contacts),JSON_PRETTY_PRINT));
    }

    public function get() {
        return $this->contacts;
    }
    
    public function getFile() {
        if(file_exists('storage/contacts.json')) {
            $this->contacts = json_decode(file_get_contents('storage/contacts.json'), true);
        }
    }
    public function handleRequest() {
        
        $action = isset($_GET['q']) ? $this->clean($_GET['q']) : (isset($_POST['q']) ? $this->clean($_POST['q']) : 'index');
  
     
        switch($action) {
            case "index":
                $this->index();
                break;
            case "add":
                $this->add();
                break;
            case "edit":
                $this->edit();
                break;
            case "store":
                $this->store($this->name,$this->phone);
                break;
            case "update":
                $this->update($this->id,$this->name,$this->phone);
                break;
            case "delete":
                $this->delete();
                break;
            default:
            echo "<h1>Ошибка</h1>";
            break;
        }
    }

    public function clean($value) {
        $value = trim($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        return $value;
    } 
}