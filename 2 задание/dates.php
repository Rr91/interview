<?php
/**
	Задача на собеседование:
		Напишите функцию, которая бы принимала 2 аргумента:
  - строку с интервалом дат через дефис (например, '2015-09-10 - 
2015-09-15')
  - строку с датой ('2015-09-11')
и возвращала булево значение - находится ли вторая дата в указанном 
интервале.
TRUE должно возвращаться также и в случае, если дата совпадает с 1 из 
границ.
Дополнительно можете реализовать поддержку и других форматов, а так же 
времени ('14.09.2015 12:10')
*/
	/**
		Решение:
	Здесь предложено два варианта функции. Принципиальное их отличие то, что в первом случае сравниваем строки, во втором числа.
	*/
	function opr($begin, $end, $search)// функция для проверки вхождения в диапазон
	{
		if($begin <= $search && $end >= $search) return true;
		else return false;
	}
	function dates1($dpzDate, $dateSearch)
	{
		$dpzDate = explode("-", $dpzDate);
		$dateSearch = explode("-", $dateSearch);

		$dateBegin = "";  
		$dateEnd = "";
		$ourDate = "";

		$len = count($dpzDate)/2; // граница дат в заданном диапазоне

		for ($i=0; $i < $len; $i++) 
		{ 
			$dateBegin .= $dpzDate[$i]; // заполняем начальную дату диапазона
			$dateEnd .= $dpzDate[$len + $i];// конечную начальную дату диапазона
			$ourDate .= $dateSearch[$i];// искомую дату
		}
		return opr($dateBegin, $dateEnd, $ourDate);//сравниваем
	}
	/**
	Здесь после разбиения заданных строк в массив, мы заполняем переводим в числа все даты и их сравниваем,
	при чем элементы массивов возводяться в степень согласно своему порядку в строке начиная с конца.
	*/
	function dates2($dpzDate, $dateSearch)
	{
		$count = strlen($dateSearch);// стандартная длина даты

		$dpzDate = explode("-", $dpzDate);
		$dateSearch = explode("-", $dateSearch);

		$dateBegin; $dateEnd; $ourDate;
		$len = count($dpzDate)/2;

		for ($i = 0; $i < $len; $i++) { 
			$razryd =  pow(10, $count); // рязряд числа

			$dateBegin += $dpzDate[$i] * $razryd; 
			$dateEnd   += $dpzDate[$len + $i] * $razryd;
			$ourDate   += $dateSearch[$i] * $razryd;

			$count -= strlen($dpzDate[$i]); // уменьшения разряда, (от года к месяцу , от месяца ко дню и.т.д)
		}
		return opr($dateBegin, $dateEnd, $ourDate);
	}
	$res = dates2('2015-09-10-2015-09-15', '2015-09-15');
	echo $res."<br />";
?>