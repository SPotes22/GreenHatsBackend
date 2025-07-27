# Chatbot orientado a facturación, entrenado con NLP clásico y montado con Flask (Hackatón 2025)
---
#  Chatbot Backend - PHP + OpenAI API

Este backend en **PHP** sirve como **puente entre la interfaz del chatbot y la API de OpenAI (GPT)**. Fue diseñado para procesar solicitudes de usuario y generar respuestas dinámicas cuando el modelo local no basta.

---

## Componentes

- PHP 7.4+
- cURL (para conectar con la API de OpenAI)
- Clever Cloud (hosting)
- MySQL Addon (para guardar logs y tokens)


---

## 🛠 Estructura Base

```
GreenHatsBackend/
├── index.php           # Punto de entrada principal para solicitudes (API)
├── FAQs.json           # Base de datos de preguntas frecuentes en formato JSON
├── Dockerfile          # Configuración para contenedor Docker
├── .dockerignore       # Archivos ignorados durante build del contenedor
├── README.md           # Documentación del backend

```

---

##  ¿Cómo funciona?

1. Recibe un `POST` con un mensaje del usuario (`question`).
2. Conecta a la API de OpenAI (`gpt-3.5-turbo`) usando cURL.
3. Devuelve una respuesta generada por el modelo.
4. (Opcional) Guarda el input/output en MySQL.

---

## Configuración de entorno

Crea un archivo `.env` con:

```dotenv
OPENAI_API_KEY=sk-xxxx
DB_HOST=localhost
DB_USER=root
DB_PASS=...
DB_NAME=chatbot_logs
```

---

##  Despliegue (Resumen de la batalla)

- Tuvimos que subir múltiples versiones del backend a **Clever Cloud**, lidiando con sesiones borradas al hacer deploy.
- Usamos `.zip` para hacer actualizaciones rápidas.
- [MicroNAS](https://github.com/SPotes22/MicroNAS-Flask) se usó como servidor de respaldo con acceso físico.
- El sistema de tokens se rompió durante el pitch por consumo excesivo → ⚠️ *usar cache o backup model next time*.

---

## 📡 Endpoints

- `POST /index.php`
  - Body: `{ "question": "¿Cómo veo mi factura?" }`
  - Header: `Content-Type: application/json`
  - Respuesta: `"Puedes ver tu factura en el portal de clientes..."`

---

##  Lecciones

- Clever Cloud borra sesión en cada deploy → usar archivos persistentes.
- Los tokens de OpenAI tienen límite → usar fallback local o caching.
- El tiempo de build puede matar el pitch → **tener siempre un mock o respuesta guardada**.

---

##  Autores

Hecho con demasiada cafeína y resiliencia por:

- Santiago Potes Giraldo
- Juan Franco
- Freddy Alejandro Aristizabal

---

## 📜 Licencia

MIT — Forkéalo, rómpelo, mejóralo.
