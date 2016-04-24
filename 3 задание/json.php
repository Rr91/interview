<?php
/**
	Задача на собеседование:
		Создайте класс, принимающий в конструкторе JSON-строку и позволяющий 
получить элемент через текучий интерфейс. Например:
$o = new JsonFluent('{"first":"apple","
second":"banana","third":{"sub1":1,"sub2":2,"sub3":3}}');
$o->get('first'); // Вернёт 'apple'
$o->get('third')->get('sub2'); // Вернёт 2

*/
class JsonFluent{     
     
    public $json;

    function __construct($js) {  

        $this->json = $js; 
        $this->json = json_decode($this->json);// декодирование для преобразования json в массив
    } 
	public function get($js)
	{
		$res = $this->json->$js; // ищем значение по ключу в переменной js

		if(is_object($res)) // если полученное значение является объектом
		{
			$res = json_encode($res);// обратное преобразование в json
			$obj = new JsonFluent($res); // создание нового экземпляра с параметром конструктора имеющим значение полученного объекта
			return $obj;// и передача созданного объекта на обраьотку второй функции get;
		}
		return $res;
	}     
} 
	$o = new JsonFluent('{"first":"apple","second":"banana","third":{"sub1":1,"sub2":2,"sub3":3}}');
	echo $o->get("third")->get("sub2")."<br/>";
	echo $o->get("first");

?>