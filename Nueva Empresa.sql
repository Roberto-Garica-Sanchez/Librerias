-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.28 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2019-08-21 22:41:24
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for control_almacen
CREATE DATABASE IF NOT EXISTS `control_almacen` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `control_almacen`;


-- Dumping structure for table control_almacen.consumidos
CREATE TABLE IF NOT EXISTS `consumidos` (
  `id` int(10) DEFAULT NULL,
  `id_cequipo` int(10) DEFAULT NULL,
  `id_cfecha` int(10) DEFAULT NULL,
  `id_cpersonal_despachado` int(10) DEFAULT NULL COMMENT 'persona que realizo la entrega del producto',
  `id_cpersonal_consumidor` int(10) DEFAULT NULL COMMENT 'persona que requiere el producto',
  `id_flujo_producto` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='productos que an salido del almacen para su uso.';

-- Data exporting was unselected.


-- Dumping structure for table control_almacen.flujo_producto
CREATE TABLE IF NOT EXISTS `flujo_producto` (
  `id` int(10) DEFAULT NULL,
  `id_producto` int(10) DEFAULT NULL COMMENT 'cuantas unidades fueron movidas',
  `id_consumidos` int(10) DEFAULT NULL COMMENT 'cuantas unidades fueron movidas',
  `unidades` int(10) DEFAULT NULL COMMENT 'cuantas unidades fueron movidas'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_almacen.mercansia
CREATE TABLE IF NOT EXISTS `mercansia` (
  `id` int(10) DEFAULT NULL,
  `id_fechas_fija` int(10) DEFAULT NULL,
  `id_Clientes` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_almacen.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(10) DEFAULT NULL,
  `valor` int(10) DEFAULT NULL,
  `nombre` int(10) DEFAULT NULL,
  `marca` int(10) DEFAULT NULL,
  `modelo` int(10) DEFAULT NULL,
  `id_cfecha` int(10) DEFAULT NULL,
  `existencias` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping database structure for control_combustible
CREATE DATABASE IF NOT EXISTS `control_combustible` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `control_combustible`;


-- Dumping structure for table control_combustible.repostaje
CREATE TABLE IF NOT EXISTS `repostaje` (
  `id` int(10) DEFAULT NULL,
  `id_cequipo` int(10) DEFAULT NULL,
  `id_tanque` int(10) DEFAULT NULL,
  `id_cfecha` int(10) DEFAULT NULL,
  `litros_despachado` int(10) DEFAULT NULL,
  `id_cpersonal_operador` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_combustible.tanques
CREATE TABLE IF NOT EXISTS `tanques` (
  `id` int(10) DEFAULT NULL,
  `capacidad` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping database structure for control_equipo
CREATE DATABASE IF NOT EXISTS `control_equipo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `control_equipo`;


-- Dumping structure for table control_equipo.camiones
CREATE TABLE IF NOT EXISTS `camiones` (
  `ID` int(10) DEFAULT NULL,
  `Marca` int(10) DEFAULT NULL,
  `Largo` int(10) DEFAULT NULL,
  `Ancho` int(10) DEFAULT NULL,
  `Color` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.


-- Dumping structure for table control_equipo.chasis
CREATE TABLE IF NOT EXISTS `chasis` (
  `ID` int(10) DEFAULT NULL,
  `Marca` int(10) DEFAULT NULL,
  `Largo` int(10) DEFAULT NULL,
  `Ancho` int(10) DEFAULT NULL,
  `Color` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.


-- Dumping structure for table control_equipo.dollys_convertidor
CREATE TABLE IF NOT EXISTS `dollys_convertidor` (
  `ID` int(10) DEFAULT NULL,
  `Marca` int(10) DEFAULT NULL,
  `Largo` int(10) DEFAULT NULL,
  `Ancho` int(10) DEFAULT NULL,
  `Color` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.


-- Dumping structure for table control_equipo.estado_equipo
CREATE TABLE IF NOT EXISTS `estado_equipo` (
  `id` int(10) DEFAULT NULL,
  `id_equipo` int(10) DEFAULT NULL,
  `Status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='esta tabla estara encargada de controlar si el equipo esta disponible para\r\n*uso imediato (el equipo esta 100% listo  para usarse )\r\n*reparacion (el equipo requiere o esta siendo reparado)\r\n*en uso  (el equipo esta siendo utilizado en un viaje/maniobra/ect.)\r\n*fuera de servicio (el equipo no puede ser usado por robo/venta/ect. )\r\n';

-- Data exporting was unselected.


-- Dumping structure for table control_equipo.plataformas
CREATE TABLE IF NOT EXISTS `plataformas` (
  `ID` int(10) DEFAULT NULL,
  `Marca` int(10) DEFAULT NULL,
  `Largo` int(10) DEFAULT NULL,
  `Ancho` int(10) DEFAULT NULL,
  `Color` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping database structure for control_fechas
CREATE DATABASE IF NOT EXISTS `control_fechas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `control_fechas`;


-- Dumping structure for table control_fechas.fechas_operacion
CREATE TABLE IF NOT EXISTS `fechas_operacion` (
  `id` int(10) DEFAULT NULL,
  `Column 2` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_fechas.fija
CREATE TABLE IF NOT EXISTS `fija` (
  `id` int(10) DEFAULT NULL,
  `fecha` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='contrendra una serie de fechas para vincular a otras tablas ';

-- Data exporting was unselected.


-- Dumping structure for table control_fechas.multiples
CREATE TABLE IF NOT EXISTS `multiples` (
  `id` int(10) DEFAULT NULL,
  `fecha1` int(10) DEFAULT NULL,
  `fecha2` int(10) DEFAULT NULL,
  `fecha3` int(10) DEFAULT NULL,
  `fecha4` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='contrendra una serie de fechas para vincular a otras tablas ';

-- Data exporting was unselected.


-- Dumping structure for table control_fechas.temporadas
CREATE TABLE IF NOT EXISTS `temporadas` (
  `id` int(10) DEFAULT NULL,
  `inicio` int(10) DEFAULT NULL,
  `final` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='contrendra una serie de fechas para vincular a otras tablas ';

-- Data exporting was unselected.


-- Dumping structure for table control_fechas.valido_hasta
CREATE TABLE IF NOT EXISTS `valido_hasta` (
  `id` int(10) DEFAULT NULL,
  `fecha` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='contrendra una serie de fechas para vincular a otras tablas ';

-- Data exporting was unselected.


-- Dumping database structure for control_fletes
CREATE DATABASE IF NOT EXISTS `control_fletes` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `control_fletes`;


-- Dumping structure for table control_fletes.cotizaciones
CREATE TABLE IF NOT EXISTS `cotizaciones` (
  `id` int(10) DEFAULT NULL,
  `origen` int(10) DEFAULT NULL,
  `destino` int(10) DEFAULT NULL,
  `formato` int(10) DEFAULT NULL,
  `id_ruta` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_fletes.multirutas
CREATE TABLE IF NOT EXISTS `multirutas` (
  `id` int(10) DEFAULT NULL,
  `id_rutas` int(10) DEFAULT NULL,
  `id_fechas_fija` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_fletes.rutas
CREATE TABLE IF NOT EXISTS `rutas` (
  `origen` int(10) DEFAULT NULL,
  `destino` int(10) DEFAULT NULL,
  `id_cgo_casetas0` int(10) DEFAULT NULL,
  `id_cgo_casetas1` int(10) DEFAULT NULL,
  `id_cgo_casetas2` int(10) DEFAULT NULL,
  `id_cgo_casetas3` int(10) DEFAULT NULL,
  `id_cgo_casetas4` int(10) DEFAULT NULL,
  `id_cgo_casetas5` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping database structure for control_gastos_operativos
CREATE DATABASE IF NOT EXISTS `control_gastos_operativos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `control_gastos_operativos`;


-- Dumping structure for table control_gastos_operativos.casetas
CREATE TABLE IF NOT EXISTS `casetas` (
  `id` int(10) DEFAULT NULL,
  `localizacion` int(10) DEFAULT NULL,
  `costo` int(10) DEFAULT NULL,
  `fecha` int(10) DEFAULT NULL,
  `estado` set('Activa','Inactiva') DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_gastos_operativos.casetas_electronica
CREATE TABLE IF NOT EXISTS `casetas_electronica` (
  `id` int(10) DEFAULT NULL,
  `localizacion` int(10) DEFAULT NULL,
  `costo` int(10) DEFAULT NULL,
  `fecha` int(10) DEFAULT NULL,
  `estado` set('Activa','Inactiva') DEFAULT NULL,
  `id_cprovedores` int(10) DEFAULT NULL,
  KEY `Index 1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.


-- Dumping database structure for control_personal
CREATE DATABASE IF NOT EXISTS `control_personal` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `control_personal`;


-- Dumping structure for table control_personal.mecanicos
CREATE TABLE IF NOT EXISTS `mecanicos` (
  `id` int(10) DEFAULT NULL,
  `id_cfechas_inicio` int(10) DEFAULT NULL COMMENT 'inicio a trabajar',
  `id_cfechas_edad` int(10) DEFAULT NULL COMMENT 'Edad',
  `nombre` int(10) DEFAULT NULL,
  `sueldo` int(10) DEFAULT NULL COMMENT 'Edad',
  `n_seguro` int(10) DEFAULT NULL COMMENT 'Edad'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.


-- Dumping structure for table control_personal.oficina
CREATE TABLE IF NOT EXISTS `oficina` (
  `id` int(10) DEFAULT NULL,
  `id_cfechas_inicio` int(10) DEFAULT NULL COMMENT 'inicio a trabajar',
  `id_cfechas_edad` int(10) DEFAULT NULL COMMENT 'Edad',
  `nombre` int(10) DEFAULT NULL,
  `sueldo` int(10) DEFAULT NULL COMMENT 'Edad',
  `n_seguro` int(10) DEFAULT NULL COMMENT 'Edad'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_personal.operadores
CREATE TABLE IF NOT EXISTS `operadores` (
  `id` int(10) DEFAULT NULL,
  `id_cfechas_inicio` int(10) DEFAULT NULL COMMENT 'inicio a trabajar',
  `id_cfechas_edad` int(10) DEFAULT NULL COMMENT 'Edad',
  `nombre` int(10) DEFAULT NULL,
  `sueldo` int(10) DEFAULT NULL COMMENT 'Edad',
  `n_seguro` int(10) DEFAULT NULL COMMENT 'Edad'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.


-- Dumping database structure for control_provedores
CREATE DATABASE IF NOT EXISTS `control_provedores` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `control_provedores`;


-- Dumping structure for table control_provedores.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(10) DEFAULT NULL,
  `id_provedor` int(10) DEFAULT NULL,
  `nombre` int(10) DEFAULT NULL,
  `costo` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_provedores.provedor
CREATE TABLE IF NOT EXISTS `provedor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `razon_social` int(10) DEFAULT NULL,
  `alias` int(10) DEFAULT NULL,
  `descricion` int(10) DEFAULT NULL,
  `telefono` int(10) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping database structure for control_taller
CREATE DATABASE IF NOT EXISTS `control_taller` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `control_taller`;


-- Dumping structure for table control_taller.hoja_servicio
CREATE TABLE IF NOT EXISTS `hoja_servicio` (
  `id` int(10) DEFAULT NULL,
  `id_cequipos` int(10) DEFAULT NULL,
  `id_cpersonal_mecanico` int(10) DEFAULT NULL COMMENT 'persona que realiza la reparacion',
  `id_fechas_fija` int(10) DEFAULT NULL,
  `Orden de trabajo` int(10) DEFAULT NULL,
  `id_calmacen_lista_productos` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table control_taller.partes
CREATE TABLE IF NOT EXISTS `partes` (
  `id` int(10) DEFAULT NULL,
  `id_cequipo` int(10) DEFAULT NULL,
  `marca` int(10) DEFAULT NULL,
  `nombre` int(10) DEFAULT NULL,
  `numero_serie` int(10) DEFAULT NULL,
  `descricion` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
