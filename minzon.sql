-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2020 a las 04:24:10
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `minzon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `rol` int(1) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(2, 'Juan Ricardo', 'Becerra Mata', 'ronkeyx5@gmail.com', '18863906ff70b8ab6af633204fd11fe6', 2, '02b23242403e2edd76727e3884d17883', 'index.jpg', 1, 0),
(11, 'Luis Antonio', 'Medellin Serna', 'luis@gmail.com', '3fc0a7acf087f549ac2b266baf94b8b1', 2, '25cd367db32760418f99462afbd48ff2', 'unnamed.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `status`, `eliminado`) VALUES
(1, 'Invitado', '', '', '', 1, 0),
(2, 'Fernando', 'Cigarra', 'fer@gmail.com', '3fc0a7acf087f549ac2b266baf94b8b1', 1, 0),
(3, 'Andrea', 'Garcia', 'andreagar@gmail.com', 'cbb489b1e97e2c947e2e1374a4388e26', 1, 0),
(4, 'Eduardo', 'Canteras', 'cantis@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 1, 0),
(5, 'Raul', 'Fernandez', 'raul@gmail.com', 'c811416626e3640491ed6a09dd9f57e9', 1, 0),
(6, 'Juan', 'Cacas', 'juan@gmail.com', '18863906ff70b8ab6af633204fd11fe6', 1, 0),
(7, 'Azucena', 'Ramos', 'susyrose@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 1, 0),
(8, 'Jose Manuel', 'Valdivia', 'josev@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 1, 0),
(9, 'Manuel', 'Ramirez', 'maanuel@gmail.com', '3fc0a7acf087f549ac2b266baf94b8b1', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `calle` text NOT NULL,
  `colonia` text NOT NULL,
  `CP` int(11) NOT NULL,
  `ciudad` text NOT NULL,
  `estado` text NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `numero_calle` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `observaciones` text NOT NULL,
  `paqueteria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id`, `user_id`, `tipo`, `calle`, `colonia`, `CP`, `ciudad`, `estado`, `nombre`, `apellidos`, `numero_calle`, `email`, `telefono`, `observaciones`, `paqueteria`) VALUES
(16, 6, 'sucursal', '', '', 0, '', '', 'Juan Ricardo', 'Mata', '', 'marymruiz1229@hotmail.com', '(333) 144-2340', '', ''),
(17, 6, 'sucursal', '', '', 0, '', '', 'Juan Ricardo', 'Mata', '', 'marymruiz1229@hotmail.com', '(333) 144-2340', '', ''),
(18, 6, 'domicilio', 'Isla Guadalupe', 'Villa Guerrero', 44987, 'Guadalajara', 'Jalisco', 'Juan Ricardo', 'Becerra Mata', '2854A', 'ronkeyx5@gmail.com', '3311530481', '', 'Fedex'),
(19, 6, 'domicilio', 'Isla Guadalupe', 'Villa Guerrero', 44987, 'GUADALAJARA', 'Jalisco', 'Juan Ricardo', 'Mata', '2854A', 'marymruiz1229@hotmail.com', '(333) 144-2340', '', 'UPS'),
(20, 9, 'sucursal', '', '', 0, '', '', 'Manuel', 'Ramirez', '', 'maanuel@gmail.com', '38849023', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `domicilio` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `paqueteria` text NOT NULL,
  `entregado` tinyint(1) NOT NULL,
  `fecha_embarque` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `entrega_estimada` date NOT NULL,
  `numero_rastreo` int(11) NOT NULL,
  `id_transaccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`id`, `user_id`, `tipo`, `domicilio`, `estado`, `paqueteria`, `entregado`, `fecha_embarque`, `fecha_entrega`, `entrega_estimada`, `numero_rastreo`, `id_transaccion`) VALUES
(10, 6, 'sucursal', 16, 'Entregado', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 2),
(11, 6, 'sucursal', 17, 'Entregado', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 3),
(12, 6, 'domicilio', 18, 'Entregado', 'Fedex', 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 4),
(13, 6, 'domicilio', 19, 'Procesando', 'UPS', 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 5),
(14, 9, 'sucursal', 20, 'Procesando', '', 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `metodo_pago` varchar(30) NOT NULL,
  `id_transaccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `usuario`, `status`, `metodo_pago`, `id_transaccion`) VALUES
(12, '2020-04-01', '6', 1, 'efectivo', 2),
(13, '2020-04-01', '6', 1, 'efectivo', 3),
(14, '2020-04-01', '6', 1, 'tarjeta', 4),
(15, '2020-04-01', '6', 1, 'efectivo', 5),
(16, '2020-04-01', '9', 1, 'efectivo', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`, `cantidad`) VALUES
(29, 12, 27, 7),
(30, 13, 27, 3),
(31, 14, 29, 1),
(32, 14, 30, 1),
(33, 14, 34, 1),
(34, 15, 22, 1),
(35, 15, 24, 1),
(36, 16, 21, 1),
(37, 16, 22, 1),
(38, 16, 24, 1),
(39, 16, 25, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `Autor` varchar(200) NOT NULL,
  `codigo` varchar(32) NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `costo` double NOT NULL,
  `stock` int(11) NOT NULL,
  `archivo_n` varchar(225) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `Autor`, `codigo`, `descripcion`, `costo`, `stock`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(21, 'El Arte de la Guerra', 'Sun Tzu', 'eag5', 'El Arte de la Guerra es el mejor libro de estrategia de todos los tiempos. Inspiró a Napoleón, Maquiavelo, Mao Tse Tung y muchas más figuras históricas. Este libro, de dos mil quinientos años de antigüedad, es uno de los más importantes textos clásicos chinos, en el que, a pesar del tiempo transcurrido, ninguna de sus máximas ha quedado anticuada, ni hay un solo consejo que hoy no sea útil. Pero la obra del general Sun Tzu no es únicamente un libro de práctica militar, sino un tratado que enseña la estrategia suprema de aplicar con sabiduría el conocimiento de la naturaleza humana en los momentos de confrontación. No es, por tanto, un libro sobre la guerra; es una obra para comprender las raíces de un conflicto y buscar una solución. “La mejor victoria es vencer sin combatir”, nos dice Sun Tzu, “y ésa es la distinción entre le hombre prudente y el ignorante”.', 200, 29, 'dfc2e73508edd168c398441a6fc1b841', 'di6xDQAAQBAJ.jpg', 1, 0),
(22, 'El Principe', 'Nicolas Maquiavelo', 'ep2', 'Este tratado filosófico aborda la cuestión del Poder y da consejos prácticos para consolidar sus posiciones en el dominio político.', 250, 18, '46aac0bf43d1ab0491e887af8c61ca23', 'erjmCgAAQBAJ.jpg', 1, 0),
(23, 'La Divina Comedia', 'Dante Alighieri', 'ldc3', 'Este ebook presenta \"La divina Comedia\", con un índice dinámico y detallado. La divina Comedia es un poema épico escrito por Dante Alighieri. Se desconoce la fecha exacta en que fue escrito. Dante Alighieri llamó sencillamente Commedia a su libro, pues, de acuerdo con el esquema clásico, no podía ser una tragedia, ya que su final es feliz. Se ha añadido el adjetivo \"divina\" en publicaciones sucesivas, después del año 1500. La divina Comedia se considera una de las obras maestras de la literatura italiana y universal. Numerosos artistas de todos los tiempos crearon ilustraciones sobre ella; destacan entre ellas las de Botticelli, Gustave Doré, Dalí, William Adolphe Bouguereau y recientemente Miquel Barceló. Dante Alighieri la escribió en dialecto toscano, matriz del italiano actual el cual se usó entre los siglos XI y XII. Características La divina Comedia es un poema donde se mezcla la vida real con la sobrenatural, muestra la lucha entre la nada y la inmortalidad, una lucha donde se superponen tres reinos, tres mundos, logrando una suma de múltiples visuales que nunca se contradicen o se anulan. Los tres mundos infierno, purgatorio y paraíso reflejan tres modos de ser de la humanidad, en ellos se reflejan el vicio, el pasaje del vicio a la virtud y la condición de los hombres perfectos. Es entonces a través de los viciosos, penitentes y buenos que se revela la vida en todas sus formas, sus miserias y hazañas, pero también se muestra la vida que no es, la muerte, que tiene su propia vida, todo como una mezcla agraciada planteada por Dante, que se vuelve arquitecto de lo universal y de lo sublime.', 300, 12, '72641ab2997edddbcf2ec01c70d9d463', 'HKNjDwAAQBAJ.jpg', 1, 0),
(24, 'Juicio Final', 'John Katzenbach', 'jf2', 'Katzenbach, maestro del suspense psicológico, nos enfrenta de nuevo a una trama tan hipnótica como las de El Psicoanalista y La historia del loco. Matthew Cowart, famoso periodista de Miami, recibe la carta de un hombre condenado a muerte que asegura ser inocente. Pese a su escepticismo inicial, Cowart empieza a investigar el caso, comprende que el acusado no cometió los delitos que se le imputan y pone al descubierto mediante sus artículos una información que permite al convicto Robert Earl Fergurson salir en libertad.  Cowart obtiene entonces un premio Pulitzer por su tarea periodística. Sin embargo, y para su horror, el escritor se percata de que ha puesto en marcha una tremenda máquina de matar y que ahora le toca a él intentar, en una carrera contra el reloj, que se haga justicia fuera de los tribunales.  John Katzenbach posee una larga trayectoria como periodista especializado en temas judiciales. Con El psicoanalista sorprendió al mundo con un thriller impactante.', 150, 11, '030e9ad0973d4551dad7ab7f38478114', '3u0QBQAAQBAJ.jpg', 1, 0),
(25, 'Cómo enamorar a una mujer', 'Paolo Ruso', 'ceaum5', 'Quizás mueres de celos al ver a la chica que te gusta de la mano de otro hombre, y peor aún, sientes una gran impotencia porque a pesar de tus esfuerzos no has logrado conquistarla. ¡NO TE PREOCUPES MÁS! En este ebook aprenderás la mejor forma para enamorar a una mujer, los diferentes consejos que Paolo Ruso te muestra en este ebook, te serán de gran ayuda.', 50, 2, 'c544e0186338cf7b2523ef5016cd41bf', 'caNtDwAAQBAJ.jpg', 1, 0),
(26, 'Locke and key 2: Juegos Mentales', 'Joe Hill, Gabriel Rodriguez', 'lak2jm6', 'La familia Locke se sobrepone al ataque de Sam Lesser en la casona Keyhows. Los Locke parecen haber olvidado todo aquello de las llaves mágicas, pero no será por mucho tiempo. La extraña mujer del pozo ha tomado una nueva forma para acercarse a la familia. Mientras tanto, llega a la Academia Lovecraft un chico misterioso llamado Zack Wells, quien de inmediato se hace amigo de los Locke. El pequeño Bode tiene en secreto una llave que encontró tras la desaparición de la mujer del pozo, y ha descubierto cuál es el misterio que encierra. ¿Cuál será el poder oculto de la llave? No te pierdas la segunda entrega de Locke & Key. Juegos Mentales.', 80, 14, 'd0a4d39ff869b8363e50ab046cebbc75', 'zJ9WDwAAQBAJ.jpg', 1, 0),
(27, 'El Gato Negro', 'Edgar Allan Poe', 'eln3', 'Edgar Allan Poe fue el gran maestro del relato de terror, además de haber inventado el relato policíaco y escrito ciencia-ficción. El Gato Negro es un inquietante relato, capaz de envolver al lector en su atmósfera mórbida, inquietante y macabra. Esperamos que disfrute de la edición digital que le ofrece Paradimage.', 300, 9, 'cc31347474a552ced8ec124d9386b97d', 'Ufz8CwAAQBAJ.jpg', 1, 0),
(28, 'Orgullo y Prejuicios', 'Jane Austen', 'oyp3', 'Este ebook presenta \"Orgullo y prejuicio\", con un índice dinámico y detallado. Una de las obras maestras de la literatura inglesa de todos los tiempos y una de las obras esenciales en la difusión de la novela como género. Se publicó por primera vez el 28 de enero de 1813 como una obra anónima, sin que figurara el nombre de su autora. Su primera frase es, además, una de las más famosas en la literatura inglesa: «Es una verdad mundialmente reconocida que un hombre soltero, poseedor de una gran fortuna, necesita una esposa.» ocupa de una realidad común en Inglaterra a principios del siglo XIX: las mujeres que no son ricas tienen que casarse bien. Y con \"bien\" queremos decir \"con un hombre rico\", de modo que cualquier tipo de una buena familia con un ingreso grande y constante cumple los requisitos para la Caza Matrimonial. ¿Hombres ricos pero no inteligentes, no guapos y aburridos? Es una novela de desarrollo personal, en la que las dos figuras principales, Elizabeth Bennet y Fitzwilliam Darcy, cada uno a su manera y, no obstante, de forma muy parecida, deben madurar para superar algunas crisis, aprender de sus errores para poder encarar el futuro en común, superando el orgullo de clase de Darcy y los prejuicios de Elizabeth hacia él. Jane Austen (1775 - 1817) fue una destacada novelista británica que vivió durante el período de la Regencia.', 170, 23, '2acf8e89be8e8f79a34f30dbae0fa3df', 'LqNjDwAAQBAJ.jpg', 1, 0),
(29, 'El Señor de los Anillos: La Comunidad del Anillo', 'J. R. R. Tolkien', 'esdlalcda8', 'En la adormecida e idílica Comarca, un joven hobbit recibe un encargo: custodiar el Anillo Único y emprender el viaje para su destrucción en las Grietas del Destino. Consciente de la importancia de su misión, Frodo abandona la Comarca e inicia el camino hacia Mordor con la compañía de inesperada de Sam, Pippin y Merry. Pero sólo con la ayuda de Aragorn conseguirán vencer a los Jinetes Negros y alcanzar el refugio de la Casa de Elrond en Rivendel.', 300, 7, '2cdf95effa0649379debff58602c13b2', 'DYmUGGwZ8_oC.jpg', 1, 0),
(30, 'El Hobbit: Volumen 1', 'J. R. R. Tolkien', 'elv14', 'Cuando alrededor de 1930, J.R.R. Tolkien comenzó a escribir El Hobbit, hacía ya diez años que trabajaba en el vasto panorama mitológico de El Libro de los Relatos, que más tarde se llamaría El Silmarillion. Así como esas crónicas tempranas narraban los mitos inmemoriales de la Primera y Segunda Edad, Tolkien pronto advirtió que El Hobbit iba ordenándose de algún modo como un relato de la Tercera Edad (Gandalf habla del Nigromante en las primeras páginas), aunque las inesperadas aventuras de un pacífico hombre del campo no parecieran tener mucha relación con las vastas y oscuras mitologías de la Tierra Media. El estilo directo y lineal, con alusiones (que el autor deploró más tarde) a un público infantil, no impide la poderosa irrupción --unas pocas veces en términos de comedia-- de los grandes temas tolkienianos (el poder, la codicia, la guerra, la muerte) que reaparecerían en una dimensión a menudo obviamente épica en El Señor de los Anillos.', 300, 8, '85988e3b6792ef51a84bfd5926e0bc61', 'xi2URRig7jYC.jpg', 1, 0),
(31, 'Harry Potter y el misterio del prÃ­ncipe', 'J. K. Rowling', 'hpyemdp7', 'En medio de graves acontecimientos que asolan el país, Harry inicia su sexto curso en Hogwarts. El equipo de quidditch, los exámenes y las chicas lo mantienen ocupado, pero la tranquilidad dura poco. A pesar de los férreos controles de seguridad, dos alumnos son brutalmente atacados. Dumbledore sabe que, tal como se anunciaba en la Profecía, Harry y Voldemort han de enfrentarse a muerte. Así pues, para intentar debilitar al enemigo, el anciano director y el joven mago emprenderán juntos un peligroso viaje con la ayuda de un viejo libro de pociones perteneciente a un misterioso personaje, alguien que se hace llamar Príncipe Mestizo.', 300, 14, '8828050b776623cf55c7af2b965902ed', 'uZDYlfDVYmEC.jpg', 1, 0),
(32, 'Fuego y Sangre', 'George R. R. Martin', 'fys3', 'El nuevo libro de George R. R. Martin narra la fascinante historia de los Targaryen, la dinastía que reinó en Poniente trescientos años antes del inicio de \"Canción de hielo y fuego\", la saga que inspiró la serie de HBO: Juego de tronos. Siglos antes de que tuvieran lugar los acontecimientos que se relatan en \"Canción de hielo y fuego\", la casa Targaryen, la única dinastía de señores dragón que sobrevivió a la Maldición de Valyria, se asentó en la isla de Rocadragón.  Aquí tenemos el primero de los dos volúmenes en el que el autor de Juego de tronos nos cuenta, con todo lujo de detalles, la historia de tan fascinante familia: empezando por Aegon I Targaryen, creador del icónico Trono de Hierro, y seguido por el resto de las generaciones de Targaryens que lucharon con fiereza por conservar el poder, y el trono, hasta la llegada de la guerra civil que casi acaba con ellos.  ¿Qué pasó realmente durante la Danzade dragones? ¿Por qué era tan peligroso acercarse a Valyria después de la Maldición? ¿Cómo era Poniente cuando los dragones dominaban los cielos? Estas, y otras muchas, son las preguntas a las que responde esta monumental crónica, narrada por un culto maestre de la Ciudadela, que anticipa el ya conocido universo de George R.R. Martin.  Fuego y Sangre brindará a los lectores la oportunidad de tener otra visión de la fascinante historia de Poniente. Esta obra, magníficamente ilustrada con 85 láminas inéditas de Doug Wheatley, se convertirá, sin duda, en una lectura ineludible para todos los fans de la aclamada serie.', 250, 13, '806d5fd328baf84016d01dd9c2c8fb65', 'NDxlDwAAQBAJ.jpg', 1, 0),
(33, 'Un Grito De Honor', 'Morgan Rice', 'ugdh4', ' \"EL ANILLO DEL HECHICERO (THE SOURCERER”S RING) tiene todos los ingredientes para ser un éxito inmediato, tramas, tramas secundarias, misterio, caballeros aguerridos y relaciones que florecen, está repleto de corazones rotos, engaño y decepciones y traiciones. Lo mantendrá entretenido durante horas y satisfará a las personas de todas las edades. Recomendado para la biblioteca habitual de todos los lectores del genero de fantasía\". --Books and Movie Reviews, Roberto Mattos     En UN GRITO DE HONOR (A CRY OF HONOR) - [Libro #4 de El Anillo del Hechicero – (The Sorcerer’s Ring), Thor ha regresado de Los Cien como un guerrero endurecido, y ahora debe aprender lo que significa la batalla por su patria, combatir por la vida y la muerte. Los McCloud han invadido el territorio de los MacGil — más adentro que nunca en la historia del Anillo — y mientras Thor cabalga hacia una emboscada, caerá sobre su cabeza repeler el ataque y salvar la Corte del Rey.    Godfrey ha sido envenenado por su hermano con un veneno muy potente y raro, y su destino está en manos de Gwendolyn, mientras ella hace todo lo que puede para salvar a su hermano de la muerte.    Gareth ha caído más profundamente en un estado de paranoia y descontento, contratando a su propia tribu de salvajes como una fuerza de lucha personal y dándoles el Salón de los Plateados — desbancando a Los Plateados y causando una ruptura en la Corte del Rey que amenaza con estallar en una guerra civil. Él también planea hacer que el feroz Nevarun se lleve a Gwendolyn, vendiéndola su en matrimonio sin su consentimiento.    Las amistades de Thor se profundizan, mientras viajan por nuevos lugares, se enfrentan a monstruos inesperados y lucha cn una batalla inimaginable. Thor viaja a su ciudad natal y, en un épico enfrentamiento con su padre, se entera de un gran secreto de su pasado, de quién es, de quién es su madre — y de su destino. Con el entrenamiento más avanzado que jamás ha recibido de Argon, comienza a tener poderes que ignoraba poseer, volviéndose más poderoso cada día. Mientras su relación con Gwen se profundiza, regresa a la Corte del Rey con la esperanza de ofrecerle matrimonio — pero puede ser demasiado tarde.    Andrónico, armado con un informante, conduce su ejército de un millón de hombres para intentar una vez más entrar al Cañón y aplastar al Anillo.    Y cuando parece que las cosas no pueden ser peores en la Corte del Rey, la historia termina con un giro sorprendente.    ¿Sobrevivirá Godfrey? ¿Gareth será expulsado? ¿La Corte del Rey se dividirá en dos? ¿Invadirá el Imperio? ¿Acabará Gwendolyn con Thor? ¿Y Thor finalmente sabrá el secreto de su destino?    Con su sofisticada construcción del mundo y caracterización, UN GRITO DE HONOR (A CRY OF HONOR) es un relato épico de amigos y amantes, de rivales y pretendientes, de caballeros y dragones, de intrigas y maquinaciones políticas, de llegar a la mayoría de edad, de corazones rotos, de decepción, de ambición y traición. Es una historia de honor y valor, de destino, de hechicería. Es una fantasía que nos lleva a un mundo que nunca olvidaremos, y que gustará a personas de todas las edades y géneros. Contiene 85.000 palabras.     \"Está llena de acción, romance, aventura y suspenso. Ponga sus manos en él y vuelva a enamorarse”.  --vampirebooksite.com (con respecto a Transformación - Turned)', 120, 4, 'f928e5fd0bc5d655975d43ae429d1cf9', '6bVkBAAAQBAJ.jpg', 1, 0),
(34, 'El Silencio de los Corderos', 'Thomas Harris', 'esdlc5', 'En este potente thriller psicológico, Clarice, cautivada por Hannibal, se enfrenta con su ayuda a un despiadado asesino. A Clarice Starling, joven y ambiciosa estudiante de la academia del FBI, le encomiendan que entreviste a Hannibal Lecter, brillante psiquiatra y despiadado asesino, para conseguir su colaboración en la resolución de un caso de asesinatos en serie. El asombroso conocimiento de Lecter del comportamiento humano y su poderosa personalidad cautivarán de inmediato a Clarice, quien, incapaz de dominarse, establecerá con él una ambigua, inquietante y peligrosa relación.  El silencio de los corderos fue llevada al cine en 1991, y ganó los Premios Oscar a las categorías mejor película, mejor dirección (Jonathan Demme), mejor actriz (Jodie Foster), mejor actor (Anthony Hopkins) y mejor guion adaptado.', 150, 4, 'f779dd417d569ec4a3030814172ff38d', 'VuIBDgAAQBAJ.jpg', 1, 0),
(35, 'Progenie', 'Susana Martín Gijón', 'p1', 'Sevilla, ola de calor. Todo el que puede huye a la playa. No así Camino Vargas, jefa accidental del Grupo de Homicidios desde el tiroteo que dejó en coma al inspector Arenas. Alguien ha atropellado salvajemente a una mujer y se ha dado a la fuga. Este asesinato se va a transformar en el foco de atención mediática cuando se filtre un dato aún más perturbador: el homicida introdujo un chupete en la boca de la víctima antes de desaparecer de la escena del crimen. Todos los indicios apuntan a la expareja, un maltratador psicológico, y las estadísticas no están de su lado. Sin embargo, cuando la autopsia desvele que la víctima estaba embarazada y los asesinatos comiencen a sucederse, Camino comprenderá que se halla ante el caso más duro de su carrera.', 60, 3, 'c9c542b2a9c5079194a24f1098df3211', 'jVi8DwAAQBAJ.jpg', 1, 0),
(36, 'Cuentos Selectos', 'Edgar Allan Poe', 'cs2', 'Edgar Allan Poe es el autor de los mejores cuentos fantásticos, de terror y de aventuras, así como también algunos de los primeros –y mejor logrados- relatos policiales de la historia de la literatura. La narrativa del autor norteamericano, caracterizada por los relatos oscuros y los argumentos siniestros, pero también por un fino y sutil sentido del humor y una maravillosa habilidad para construir personajes, posee la enorme cualidad de la variedad de temas, en los que explora y ahonda hasta sus bordes más insospechados. Estamos frente a la obra de una imaginación prodigiosa, sin lugar a dudas, una imaginación que se esmeró en recorrer todos los rincones de la experiencia humana, revisar minuciosamente y narrarlo todo. Esta antología incluye sus cuentos más célebres (como “La caída de la Casa Usher” y “El gato negro”), los que más le gustaban a su autor (“Ligeia” era su cuento favorito) y otros que, aún siendo menos conocidos, ejemplifican su versatilidad a la hora de cultivar distintos géneros.', 390, 25, 'dde3fa580de4532c30cdf32803994d46', 'FUgMAQAAQBAJ.jpg', 1, 0),
(37, 'Sherlock Holmes', 'Arthur Conan Doyle', 'sh2', 'El presente ebook recoge todas las novelas protagonizadas por Sherlock Holmes, el emblemático y perspicaz detective del 221 B de Baker Street: una obra absolutamente única! Las novelas: 1. Estudio en escarlata 2. El signo de los cuatro 3. El sabueso de los Baskerville 4. El valle del terror 5. Las aventuras de Sherlock Holmes: •Escándalo en Bohemia. •La Liga de los Pelirrojos. •Un caso de identidad. •El misterio del valle Boscombe. •Las cinco semillas de naranja. •El hombre del labio torcido. •El carbunclo azul. •La banda de lunares. •El dedo pulgar del ingeniero •El aristócrata solterón •La corona de Berilos •El misterio de Copper Beeches 6. Las memorias de Sherlock Holmes •Estrella de plata •La aventura de la caja de cartón* •El rostro amarillo •El oficinista del corredor de bolsa •La corbeta \"Gloria Scott •El ritual de los Musgrave •Los hacendados de Reigate •La aventura del jorobado •El paciente interno •El intérprete griego •El tratado naval •El problema final 7. El regreso de Sherlock Holmes •La casa deshabitada (La casa vacía) •El constructor de Norwood •Los bailarines •El ciclista solitario •El colegio Priory •La aventura del negro Peter (Peter el negro) •Charles Augustus Milverton •Los seis napoleones (El busto de Napoleón) •Los tres estudiantes •Las gafas de oro (Los quevedos de oro) •El tres cuartos desaparecido •La granja Abbey •La segunda mancha 8. Su última reverencia. •El pabellón Wisteria (La aventura de Wisteria Lodge) •La aventura de la caja de cartón •El círculo rojo •Los planos del Bruce-Partington •El detective moribundo •La desaparición de lady Frances Carfax •El pie del diablo •Su último saludo en el escenario 9. El archivo de Sherlock Holmes •La piedra de Mazarino •El problema del puente de Thor •El hombre que trepaba •El vampiro de Sussex •Los tres Garrideb •El cliente ilustre •Los tres gabletes •El soldado de la piel decolorada •La melena de león •El fabricante de colores retirado •La inquilina del velo •Shoscombe Old Place', 300, 9, '88830ea6fa69fb855ebe4a60be0f7a99', '_U-qDAAAQBAJ.jpg', 1, 0),
(38, 'La Reina Roja', 'Juan Gomez Jurado', 'lrr3', 'No has conocido a nadie como ella... Vuelve el autor español de thriller más leído en todo el mundo.  Antonia Scott es especial. Muy especial.  No es policía ni criminalista. Nunca ha empuñado un arma ni llevado una placa, y, sin embargo, ha resuelto decenas de crímenes.  Pero hace un tiempo que Antonia no sale de su ático de Lavapiés. Las cosas que ha perdido le importan mucho más que las que esperan ahí fuera.  Tampoco recibe visitas. Por eso no le gusta nada, nada, cuando escucha unos pasos desconocidos subiendo las escaleras hasta el último piso.  Sea quien sea, Antonia está segura de que viene a buscarla.  Y eso le gusta aún menos.', 250, 14, '8f74639da1b4356bc633a35167ddf32f', 'SilxDwAAQBAJ.jpg', 1, 0),
(39, 'Una Razón para Huir', 'Blake Pierce', 'urph4', '\"Una dinámica historia que atrapa desde el primer capítulo y no deja ir.\" --Midwest Book Review, Diane Donovan (sobre Una Vez Desaparecido)   Del autor de misterio #1 mejor vendido Blake Pierce llega una nueva obra maestra del suspenso psicológico.  En UNA RAZÓN PARA HUIR  (Un misterio de Avery Black—Libro 2), un nuevo asesino serial acecha a Boston, matando a sus víctimas de maneras extrañas, provocando a la policía con misteriosos rompecabezas que hacen referencia a las estrellas. A medida que las apuestas suben y la presión aumenta, el Departamento de Policía de Boston es forzado a llamar a su más brillante, y más controversial, detective de homicidios: Avery Black.  Avery, aún conmovida por su último caso, se encuentra enfrentada a una comisaría rival y un brillante e ingenioso asesino que siempre está un paso delante de ella. Se ve forzada a entrar a su oscura y retorcida mente a medida que él deja pistas para su siguiente asesinato, y forzada a buscar en lugares en su propia mente adonde preferiría no entrar. Se encuentra obligada a buscar el consejo de Howard Randall, el retorcido asesino serial al que puso tras las rejas años atrás, todo mientras su nueva y floreciente vida con Rose y Ramírez se derrumba.  Y justo cuando las cosas no podrían ser peores, descubre algo más: ella misma puede ser una víctima.', 120, 16, '1d33e666bdd30f209cffc69fc02877fc', '0QA7DwAAQBAJ.jpg', 1, 0),
(40, 'La clave está en Rebeca', 'Ken Follet', 'lceer5', 'Una apasionante historia de espías entre el desierto de África y El Cairo durante la Segunda Guerra Mundial. Esta impactante novela nos lleva a las ardientes arenas de África del Norte durante la Segunda Guerra Mundial. Las fuerzas alemanas, al mando del mariscal Rommel, se enfrentan a las tropas británicas.  Al mismo tiempo, en El Cairo se desarrolla una intriga protagonizada por el servicio secreto británico y el espionaje alemán, en la que se verá implicado el joven oficial Sadat.  La crítica ha dicho... «Te mantendrá despierto y fascinado toda la noche.» Chicago Sun-Times', 120, 7, '24d0a6b8758f3592491f2503948d398e', 'EZuGAgAAQBAJ.jpg', 1, 0),
(41, 'El Envio', 'Sebastian Fitzek', 'ee2', 'Un nuevo magnífico thriller del autor de Terapia, El pasajero 23 y El proyecto Joshua. Desde que fue violada en una habitación de hotel, la joven psiquiatra Emma Stein ya no abandona su casa. Había sido la tercera víctima de un psicópata asesino y la única que escapó con vida, aunque sin verle la cara.  Un día el cartero deja un paquete destinado a su vecino, a quien no conoce. Al aceptarlo no imagina que está a punto de comenzar su peor pesadilla...', 150, 11, '5fd030d956aa034e79167e53264a6857', 'AaJBDwAAQBAJ.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `id` int(11) NOT NULL,
  `metodo` varchar(50) NOT NULL,
  `cantidad` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`id`, `metodo`, `cantidad`, `fecha`) VALUES
(2, 'efectivo', 2100, '2020-04-01'),
(3, 'efectivo', 900, '2020-04-01'),
(4, 'tarjeta', 750, '2020-04-01'),
(5, 'efectivo', 400, '2020-04-01'),
(6, 'efectivo', 800, '2020-04-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
