<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Медицинский поиск - Орёл</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
        }
        
        .header {
            background-color: #2c6ca3;
            color: white;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        
        .city-name {
            font-size: 24px;
            font-weight: bold;
            white-space: nowrap;
        }
        
        .site-name {
            font-size: 18px;
            opacity: 0.9;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }
        
        .login-btn {
            background-color: white;
            color: #2c6ca3;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .search-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            text-align: center;
        }
        
        .search-title {
            font-size: 28px;
            margin-bottom: 25px;
            color: #333;
        }
        
        .search-box {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .search-btn {
            background-color: #2c6ca3;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 30px;
        }
        
        .help-link {
            display: inline-block;
            background-color: #ff6b6b;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .help-link:hover {
            background-color: #ff5252;
        }
        
        /* Модальное окно */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }
        
        .modal {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            min-width: 400px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        
        .modal-title {
            font-size: 22px;
            margin-bottom: 20px;
            color: #2c6ca3;
            text-align: center;
        }
        
        .category-list {
            list-style: none;
            margin-bottom: 20px;
        }
        
        .category-item {
            padding: 15px;
            margin: 10px 0;
            background-color: #f0f7ff;
            border-left: 4px solid #2c6ca3;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .category-item:hover {
            background-color: #e1f0ff;
        }
        
        .close-btn {
            background-color: #ddd;
            color: #333;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }
        
        .back-btn {
            background-color: #2c6ca3;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        
        .details-container {
            max-height: 400px;
            overflow-y: auto;
            margin: 20px 0;
        }
        
        .details-item {
            padding: 12px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
        }
        
        .details-title {
            font-weight: bold;
            color: #2c6ca3;
        }
        
        .details-count {
            background-color: #ff6b6b;
            color: white;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <!-- Город слева -->
        <div class="city-name">Орёл</div>
        
        <!-- Название сайта по центру -->
        <div class="site-name">Медицинский поиск</div>
        
        <!-- Кнопка входа справа -->
        <button class="login-btn" onclick="window.location.href='login.php'">Войти</button>
    </div>
    
    <div class="search-container">
        <div class="search-title">Врачи, клиники, услуги...</div>
        <input type="text" class="search-box" placeholder="Введите запрос для поиска...">
        <button class="search-btn">Поиск</button>
        <br>
        <a class="help-link" id="helpLink">Нужна помощь?</a>
    </div>
    
    <!-- Модальное окно выбора категории -->
    <div class="modal-overlay" id="categoryModal">
        <div class="modal">
            <div class="modal-title">Выберите нужное</div>
            <ul class="category-list">
                <li class="category-item" data-type="org">Медицинская организация</li>
                <li class="category-item" data-type="doctor">Врач</li>
                <li class="category-item" data-type="service">Услуга</li>
                <li class="category-item" data-type="diagnostic">Диагностика</li>
            </ul>
            <button class="close-btn" onclick="closeModal()">Закрыть</button>
        </div>
    </div>
    
    <!-- Модальное окно деталей -->
    <div class="modal-overlay" id="detailsModal">
        <div class="modal">
            <div class="modal-title" id="detailsTitle"></div>
            <div class="details-container" id="detailsContent"></div>
            <button class="back-btn" onclick="backToCategories()">Назад</button>
            <button class="close-btn" onclick="closeDetails()">Закрыть</button>
        </div>
    </div>
    
    <script>
        // Данные для Орловской области
        const data = {
            org: [
                {name: "Орловская областная клиническая больница", count: 1},
                {name: "Городская больница №1", count: 1},
                {name: "Детская областная больница", count: 1},
                {name: "Стоматологические поликлиники", count: 12},
                {name: "Частные медицинские центры", count: 25}
            ],
            doctor: [
                {name: "Врач-уролог", count: 18},
                {name: "Терапевт", count: 145},
                {name: "Хирург", count: 67},
                {name: "Педиатр", count: 89},
                {name: "Гинеколог", count: 54},
                {name: "Невролог", count: 42},
                {name: "Кардиолог", count: 31},
                {name: "Офтальмолог", count: 28},
                {name: "Отоларинголог (ЛОР)", count: 23},
                {name: "Стоматолог", count: 112}
            ],
            service: [
                {name: "Первичный прием врача", count: "от 800 руб."},
                {name: "Повторный прием", count: "от 500 руб."},
                {name: "Вызов врача на дом", count: "от 1500 руб."},
                {name: "ЭКГ", count: "от 500 руб."},
                {name: "УЗИ органов брюшной полости", count: "от 1200 руб."}
            ],
            diagnostic: [
                {name: "МРТ", count: "в 8 клиниках"},
                {name: "КТ", count: "в 6 клиниках"},
                {name: "Эндоскопия", count: "в 15 клиниках"},
                {name: "Лабораторная диагностика", count: "в 32 клиниках"},
                {name: "Рентген", count: "в 24 клиниках"}
            ]
        };
        
        // Тексты заголовков
        const titles = {
            org: "Медицинские организации в Орловской области",
            doctor: "Врачи в Орловской области",
            service: "Медицинские услуги",
            diagnostic: "Диагностические исследования"
        };
        
        // Открытие модального окна категорий
        document.getElementById('helpLink').addEventListener('click', function() {
            document.getElementById('categoryModal').style.display = 'block';
        });
        
        // Закрытие модального окна
        function closeModal() {
            document.getElementById('categoryModal').style.display = 'none';
        }
        
        // Закрытие окна деталей
        function closeDetails() {
            document.getElementById('detailsModal').style.display = 'none';
        }
        
        // Назад к категориям
        function backToCategories() {
            document.getElementById('detailsModal').style.display = 'none';
            document.getElementById('categoryModal').style.display = 'block';
        }
        
        // Обработка клика по категории
        document.querySelectorAll('.category-item').forEach(item => {
            item.addEventListener('click', function() {
                const type = this.getAttribute('data-type');
                showDetails(type);
            });
        });
        
        // Показать детальную информацию
        function showDetails(type) {
            document.getElementById('categoryModal').style.display = 'none';
            document.getElementById('detailsTitle').textContent = titles[type];
            
            const container = document.getElementById('detailsContent');
            container.innerHTML = '';
            
            data[type].forEach(item => {
                const div = document.createElement('div');
                div.className = 'details-item';
                div.innerHTML = `
                    <div class="details-title">${item.name}</div>
                    <div class="details-count">${item.count}</div>
                `;
                container.appendChild(div);
            });
            
            document.getElementById('detailsModal').style.display = 'block';
        }
        
        // Закрытие по клику вне модального окна
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                closeModal();
                closeDetails();
            }
        });
        
        // Обработка поиска
        document.querySelector('.search-btn').addEventListener('click', function() {
            const query = document.querySelector('.search-box').value;
            if (query.trim()) {
                alert(`Выполняется поиск: "${query}"\nВ реальном приложении здесь будет перенаправление на страницу результатов.`);
            } else {
                alert('Введите запрос для поиска');
            }
        });
        
        // Обработка нажатия Enter в поле поиска
        document.querySelector('.search-box').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.querySelector('.search-btn').click();
            }
        });
    </script>
</body>
</html>