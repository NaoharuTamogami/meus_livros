-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/06/2025 às 20:18
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `meus_livros`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `usuario_id`, `titulo`, `autor`, `descricao`, `data_criacao`) VALUES
(1, 1, 'A Sociedade Industrial e Seu Futuro', 'Theodore John Kaczynski', 'Industrial Society and Its Future (\"A Sociedade Industrial e o seu Futuro\", em livre tradução), mais conhecido como Manifesto do Unabomber, é o ensaio anti-tecnológico escrito por Ted Kaczynski, eco-terrorista estadunidense, enviado aos jornais The New York Times e The Washington Post, sua publicação pelo segundo permitiu que o FBI, através da análise linguística e a participação do irmão do primeiro, identificasse a autoria dos ataques e a consequente prisão de Ted que, por enviar cartas-bombas a alvos específicos, recebera o apelido de Unabomber (do acrônimo dado ao caso pelo FBI — unabom — para \"bombardeio a universidades e linhas aéreas\") pelos ataques realizados entre 1978 e 1995.[', '2025-06-17 18:14:13'),
(2, 1, 'Sol e Aço', 'Yukio Mishima ', 'Ensaio autobiográfico do escritor japonês Yukio Mishima. Publicado pela primeira vez em 1965, o livro explora a relação do autor com seu próprio corpo e a busca pela perfeição física e artística. Mishima usa a metáfora do \"sol e aço\" para simbolizar a dualidade entre o esclarecimento espiritual e intelectual (o sol) e a força física e disciplina (o aço). ', '2025-06-17 18:15:06'),
(3, 1, 'Meridiano de Sangue', 'Cormac McCarthy', 'Ambientada na fronteira americana, a narrativa segue um menino fictício do Tennessee conhecido como \"o garoto\", com a maior parte do texto dedicada às suas experiências com a gangue Glanton, um grupo histórico de caçadores de escalpos que massacraram Índios americanos e outros na fronteira entre os Estados Unidos e o México de 1849 a 1850 em busca de recompensa, prazer sádico e, eventualmente, por hábito niilista. O antagonista é juiz Holden, um membro da gangue fisicamente corpulento, muito educado e quase sobrenaturalmente habilidoso, extremamente pálido e completamente sem pelos.', '2025-06-17 18:16:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `email`, `senha`, `data_cadastro`) VALUES
(1, 'Tuntakamon', 'teste@teste123.com', '$2y$10$w9LLrIVAehv43N5YwZCUbeos0jjvhIQUO5fG99PTLo8bMo3xKlGda', '2025-06-17 18:12:13'),
(2, 'jooj', 'jooj@jooj.com', '$2y$10$9UW0qW1QQr4aTVpSoxS73.5.N72xIJtw0pHRv85l4yOZTNswU7.gq', '2025-06-17 18:16:39');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `livros_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
