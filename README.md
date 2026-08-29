# ChanoDev — WordPress Portfolio & Engineering Theme

[![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-21759B?logo=wordpress&logoColor=white)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?logo=php&logoColor=white)](https://php.net)
[![Vanilla JS](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![License](https://img.shields.io/badge/License-GPLv2%2B-blue.svg)](http://www.gnu.org/licenses/gpl-2.0.html)

**ChanoDev** es un tema hijo (*child theme*) para WordPress diseñado y optimizado desde cero para el portafolio profesional y plataforma de servicios de ingeniería de software de **Chano Vera**.

Construido bajo los principios de **arquitectura limpia**, **cero dependencias externas innecesarias (*Zero Bloatware*)**, **Core Web Vitals óptimos (PageSpeed 95+)** y datos estructurados avanzados con **Schema.org (E-E-A-T)**.

---

## ⚡ Características Principales

- **Arquitectura Modular de Plantillas**: Desacoplamiento por secciones mediante bucles dinámicos con fallbacks integrados, permitiendo fácil mantenimiento y activación/desactivación de componentes.
- **Rendimiento Extremo (WPO & Core Web Vitals)**:
  - LCP inferior a 1.2s y 0 CLS.
  - Soporte para formatos AVIF/WebP de última generación.
  - Transiciones y micro-animaciones aceleradas por GPU (Web Animations API y CSS Tokens).
- **Custom Post Type (CPT) de Proyectos**:
  - Taxonomías dedicadas (`project_type`, `technology`).
  - Metadatos técnicos estructurados (rol, métricas de impacto, URL en vivo, repositorio, etc.).
- **Datos Estructurados E-E-A-T**:
  - Inyección dinámica de Schema JSON-LD para `Person`, `ProfessionalService` y `CreativeWork/SoftwareApplication`.
- **Integración de Reservas**:
  - Soporte optimizado para widget de reuniones/citas Atmeetly con precarga inteligente y redimensión reactiva vía `postMessage`.

---

## 🛠️ Stack Tecnológico

| Capa | Tecnología |
| :--- | :--- |
| **Backend** | PHP 8.1+ estricto, WordPress Hooks, REST API, CPT & Taxonomías |
| **Frontend** | Vanilla ES6+ (Zero jQuery/Librerías pesadas), Web Animations API |
| **Estilos** | CSS Moderno, CSS Grid, Flexbox, Tokens CSS HSL nativos |
| **Campos & CMS** | Advanced Custom Fields Pro (con fallbacks nativos en código) |
| **SEO & Datos** | JSON-LD Schema.org, OpenGraph dinámico, Twitter Cards |

---

## 📁 Estructura del Proyecto

```text
chanodev/
├── assets/
│   ├── css/
│   │   └── portfolio.css         # Estilos globales y componentes del portafolio
│   ├── js/
│   │   └── portfolio.js          # Lógica interactiva (carruseles, decks 3D, tabs)
│   └── images/                   # Ilustraciones SVG, esquemas y mockups
├── inc/
│   ├── acf-fields.php            # Registro y definición de campos personalizados
│   ├── portfolio-cpt.php         # Registro del CPT 'project' y taxonomías
│   └── schema-eeat.php           # Inyección de Schema.org JSON-LD E-E-A-T
├── templates/
│   ├── front-page/               # Módulos de la portada (hero, pillars, projects, etc.)
│   ├── about/                    # Módulos de Sobre Mí (hero, metrics, skills, timeline, etc.)
│   ├── services/                 # Módulos de Servicios (hero, offer, method, authority, etc.)
│   ├── template-about.php        # Plantilla de página: Sobre Mí
│   ├── template-services.php     # Plantilla de página: Servicios
│   ├── template-contact.php      # Plantilla de página: Contacto
│   ├── template-legal.php        # Plantilla de página: Aviso Legal / Privacidad
│   └── template-add-project.php  # Plantilla para frontend submission / demo
├── archive-project.php           # Archivo de casos de estudio
├── single-project.php            # Vista individual de proyecto
├── front-page.php                # Plantilla principal de inicio
├── functions.php                 # Enqueue scripts, constantes y helpers
├── style.css                     # Declaración del Child Theme
└── .gitignore                    # Reglas de exclusión de Git
```

---

## 🚀 Instalación y Uso

1. Clona el repositorio dentro de tu instalación de WordPress en el directorio de temas:
   ```bash
   cd wp-content/themes/
   git clone https://github.com/chanovera-dev/chanodev.git
   ```
2. Asegúrate de tener el tema padre `stories` en `wp-content/themes/stories`.
3. Activa el tema **ChanoDev** desde el panel de administración de WordPress (*Apariencia > Temas*).
4. *(Opcional)* Activa el plugin **Advanced Custom Fields Pro** para gestionar dinámicamente todos los contenidos desde el backend. Si no está instalado, el tema continuará funcionando gracias a sus valores de fallback integrados.

---

## 👨‍💻 Autor

**Chano Vera**
- Sitio Web: [relatosycartas.com](https://relatosycartas.com/)
- GitHub: [@chanovera-dev](https://github.com/chanovera-dev)

---

## 📄 Licencia

Distribuido bajo la licencia [GNU General Public License v2 o posterior](http://www.gnu.org/licenses/gpl-2.0.html).
