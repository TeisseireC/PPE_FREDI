INSERT INTO ligne_de_frais (IdFrais, DateFrais, Trajet, Km, CoutTrajet, CoutPeage, CoutRepas, CoutHebergement, CoutTotal, IdBordereau, IdMotifs)
VALUES
(1, "2017-02-05", "Paris-Toulouse", 500, 100, 20, 50, 35, NULL, 1, 1),
(2, "2017-02-06", "Toulouse-Paris", 500, 100, 20, 50, 0, NULL, 1, 1),
(3, "2017-02-07", "Paris-Nantes", 100, 20, 5, 0, 60, NULL, 1, 1),
(4, "2017-02-08", "Nantes-Marseille", 300, 60, 20, 35, 25, NULL, 1, 1),
(5, "2018-02-05", "Paris-Toulouse", 400, 80, 15, 50, 35, NULL, 2, 1),
(6, "2018-02-05", "Paris-Toulouse", 600, 150, 20, 40, 35, NULL, 3, 1);