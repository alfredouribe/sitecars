# Proyecto de Clonación

Este proyecto está destinado a ser un sistema de gestión que incluye el manejo de usuarios, clientes, suscripciones y más.

## 🔧 Pasos de Instalación

1. **Instalar dependencias PHP:**
    ```bash
    composer install
    ```

2. **Copiar el archivo de configuración del entorno:**
    ```bash
    cp .env.example .env
    ```

3. **Generar la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```

4. **Instalar dependencias JavaScript:**
    ```bash
    npm install
    ```

---

# 🥳 Uso de Toast

El sistema utiliza el componente **Toast** para mostrar mensajes emergentes.

```javascript
this.$toast.success("Mensaje");  // Éxito
this.$toast.error("Mensaje");    // Error
this.$toast.info("Mensaje");     // Información
this.$toast.warning("Mensaje"); // Advertencia
```

# 📦 SweetAlert2 - Uso en Vue 2

Este proyecto utiliza [SweetAlert2](https://sweetalert2.github.io/) para mostrar alertas modernas, confirmaciones e inputs interactivos.

## ✅ Instalación

```bash
npm install sweetalert2
#Alert Use
🚀 1. Alerta básica
Swal.fire('Hola Mundo');

✅ 2. Alerta con título y texto
Swal.fire({
  title: 'Acción completada',
  text: 'El registro ha sido guardado correctamente',
  icon: 'success'
});

⚠️ 3. Confirmación antes de una acción
Swal.fire({
  title: '¿Estás seguro?',
  text: 'Esta acción no se puede deshacer',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Sí, continuar',
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    // Ejecutar acción
  }
});

❌ 4. Alerta de error
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Algo salió mal!',
});

ℹ️ 5. Alerta de información
Swal.fire({
  icon: 'info',
  title: 'Información',
  text: 'Este es un mensaje informativo.',
});

⏳ 6. Con temporizador (sin botones)
Swal.fire({
  title: 'Procesando...',
  timer: 2000,
  showConfirmButton: false,
  willOpen: () => {
    Swal.showLoading();
  }
});

📋 7. Alerta con input
Swal.fire({
  title: 'Ingresa tu nombre',
  input: 'text',
  inputPlaceholder: 'Nombre completo',
  showCancelButton: true
}).then((result) => {
  if (result.isConfirmed) {
    console.log('Nombre:', result.value);
  }
});

🖼️ 8. Mostrar imagen personalizada
Swal.fire({
  title: 'Bienvenido',
  text: 'Gracias por usar nuestra app',
  imageUrl: '/img/logo.png',
  imageWidth: 100,
  imageHeight: 100,
  imageAlt: 'Logo'
});


🎯 9. Redirección después de confirmar
Swal.fire({
  title: 'Sesión finalizada',
  text: 'Serás redirigido al login',
  icon: 'info',
  confirmButtonText: 'Aceptar'
}).then(() => {
  window.location.href = '/login';
});


🔁 10. Usar múltiples pasos (wizard)
Swal.mixin({
  progressSteps: ['1', '2', '3'],
  confirmButtonText: 'Siguiente',
  showCancelButton: true,
}).queue([
  {
    title: 'Paso 1',
    text: 'Primera pregunta'
  },
  {
    title: 'Paso 2',
    text: 'Segunda pregunta'
  },
  {
    title: 'Paso 3',
    text: 'Final'
  }
]);


🎨 11. Personalización de botones y estilos
Swal.fire({
  title: '¿Eliminar?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Sí, eliminar'
});
