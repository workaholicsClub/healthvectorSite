<?php
//Различные настройки сайта

class Config {
    const PROJECT_NAME = 'healthvector';  //Название сайта
    //const USING_CACHE = 'N'; //использовать ли кеширование bitrix в каталоге

    //список ID инфоблоков
    const IBLOCK_CONFIG = 5;                    //Конфигурация
    
    const IBLOCK_FEEDBACK = 6;                  //Форма: Сообщения
    const IBLOCK_CALLBACK = 12;                  //Форма: Перезвонить

    const  IBLOCK_MAIN_SLIDER = 9; //Услуги
    const  IBLOCK_NEWS = 10; // новости
    const  IBLOCK_ARTICLES = 11; // Статьи
    const  IBLOCK_SCIENCE = 28; // Научные публикации


    const  IBLOCK_TESTS = 13; // Тесты
    const  IBLOCK_QUESTIONS = 14; // Вопросы для тестов
    const  IBLOCK_RESULTS = 15; // Результаты тестирования

    const  IBLOCK_DOCTORS = 16; //Доктора
    
    const  IBLOCK_REPORTS = 22; //Отчетсноть


    const  IBLOCK_ADS = 25; //Объявления
    const  IBLOCK_EVENTS = 26; //Мероприятия
    
    const IBLOCK_COMMENTS = 27; //Комментарии
    const IBLOCK_REQUESTS = 30;//заявки


    const DEBUG = true; //отладка

    //const NO_PIC_ROUND = '/image/doctors/no-photo.png';
   // const PRICE_NO_IMG = '/image/price-icon.png';
    const  DEFAULT_ICO_DOC = '/image/specialist_psychologist-ico.png';
    const DEFAULT_PIC_ADD_LINKS = '/image/art-inform-img.jpg';
    ///
    static public function GetConstants() {
        $oClass = new ReflectionClass( __CLASS__ );
        return $oClass->getConstants();
    }//GetConstants
}
