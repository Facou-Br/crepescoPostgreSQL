DROP TABLE IF EXISTS prod_ingr;
CREATE TABLE IF NOT EXISTS prod_ingr (
  IdIngred int NOT NULL,
  IdProd int NOT NULL,
  Quant int NOT NULL,
  PRIMARY KEY (IdIngred,IdProd),
  UNIQUE KEY ID_Comporte_IND (IdIngred,IdProd),
  KEY FKCom_PRO (IdProd)
)

--
-- Contraintes pour la table com_det
--
ALTER TABLE com_det
    ADD CONSTRAINT FKCon_COM FOREIGN KEY (NumCom) REFERENCES commande (NumCom),
    ADD CONSTRAINT FKCon_DET_FK FOREIGN KEY (Num_OF) REFERENCES detail (Num_OF);

--
-- Contraintes pour la table det_ingr
--
ALTER TABLE det_ingr
    ADD CONSTRAINT FKUti_DET FOREIGN KEY (Num_OF) REFERENCES detail (Num_OF),
    ADD CONSTRAINT FKUti_ING FOREIGN KEY (IdIngred) REFERENCES ingredient (IdIngred);

--
-- Contraintes pour la table fourn_ingr
--
ALTER TABLE fourn_ingr
    ADD CONSTRAINT FKPro_FOU FOREIGN KEY (NomFourn) REFERENCES fournisseur (NomFourn),
    ADD CONSTRAINT FKPro_ING FOREIGN KEY (IdIngred) REFERENCES ingredient (IdIngred);

--
-- Contraintes pour la table prod_ingr
--
ALTER TABLE prod_ingr
    ADD CONSTRAINT FKCom_ING FOREIGN KEY (IdIngred) REFERENCES ingredient (IdIngred),
    ADD CONSTRAINT FKCom_PRO FOREIGN KEY (IdProd) REFERENCES produit (IdProd);

--
-- Déchargement des données de la table fourn_ingr
--

INSERT INTO fourn_ingr (NomFourn, IdIngred, PrixUHT) VALUES
                        ('Casino', 1, 7),
                        ('Casino', 2, 5),
                        ('Casino', 3, 6),
                        ('Casino', 4, 4),
                        ('Casino', 5, 8),
                        ('Casino', 6, 9),
                        ('Casino', 7, 10),
                        ('Casino', 8, 11),
                        ('Casino', 9, 12),
                        ('Casino', 10, 13),
                        ('Casino', 11, 14),
                        ('Casino', 12, 15),
                        ('Casino', 13, 16),
                        ('Casino', 14, 17),
                        ('Casino', 15, 18),
                        ('Casino', 16, 19),
                        ('Casino', 17, 20),
                        ('Casino', 18, 21),
                        ('Casino', 19, 22),
                        ('Casino', 20, 23),
                        ('TransGourmet',21, 4),
                        ('TransGourmet', 22, 7),
                        ('TransGourmet', 23, 5),
                        ('TransGourmet', 24, 6),
                        ('TransGourmet', 25, 4),
                        ('TransGourmet', 26, 8),
                        ('TransGourmet', 27, 9),
                        ('Aldi', 28, 10),
                        ('Aldi', 29, 11),
                        ('Aldi', 30, 12),
                        ('Carrefour', 31, 13),
                        ('Carrefour', 32, 14),
                        ('Carrefour', 33, 15),
                        ('Carrefour', 34, 16),
                        ('Carrefour', 35, 17),
                        ('Carrefour', 36, 18),
                        ('Carrefour', 37, 19),
                        ('Coca‑Cola Company', 39, 3);



--
-- Déchargement des données de la table prod_ingr
--

INSERT INTO prod_ingr (IdIngred, IdProd, Quant) VALUES
                   (1, 1, 1),
                   (1, 2, 1),
                   (2, 1, 2),
                   (2, 2, 1),
                   (3, 1, 1),
                   (3, 3, 2),
                   (5, 1, 1),
                   (6, 1, 1),
                   (7, 1, 3),
                   (8, 1, 4),
                   (9, 1, 1);

--
-- Déchargement des données de la table det_ingr
--

INSERT INTO det_ingr (Num_OF, IdIngred) VALUES
         (1, 1),
         (2, 2),
         (3, 3),
         (4, 1),
         (5, 2),
         (6, 3),
         (7, 1),
         (8, 2),
         (9, 3),
         (10, 1),
         (11, 2),
         (12, 3),
         (13, 1);