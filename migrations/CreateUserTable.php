<?php
class CreateUserTable {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Créer la table users
    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS es_user (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(100) NOT NULL,
            lastname VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('admin', 'teacher', 'student', 'viewer') NOT NULL DEFAULT 'viewer',
            date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $this->pdo->exec($sql);
    }

    public function insert() {
        $sql = 'INSERT IGNORE INTO es_user (firstname, lastname, email, password, role) VALUES
                    ("John", "Doe", "john.doe1@example.com", "$2y$10$uFG0xCFSJx1o5A8oLqP/4e0.2TT9lV2ENjXBX8FkmlBs96/JM.YvO", "admin"),
                    ("Jane", "Smith", "jane.smith2@example.com", "$2y$10$jb7F/lAwRgflf8N0UySkd.3Ep8kRJHbHfYRPcT1LJrn98nZqfkiTC", "teacher"),
                    ("Tom", "Brown", "tom.brown3@example.com", "$2y$10$R91lGmDhPLHkP0bBflcRmOixCmzXnBZpB8SB.KYrKmnCl3z9tw3GW", "student"),
                    ("Emily", "Johnson", "emily.johnson4@example.com", "$2y$10$fDoF.rzFz2d/oNHHmGc3WuQo3MHpYAxJnl8rFbQsVgbHPKY1FnOjq", "student"),
                    ("Chris", "Davis", "chris.davis5@example.com", "$2y$10$OIJ9CG4oaIj02n03S.kS8OgI4XysvMKlVDRMQGuUZ0JaOtWS0/ZHC", "teacher"),
                    ("Anna", "Garcia", "anna.garcia6@example.com", "$2y$10$EAp.jn3Dz/8UtxFsIBy.O.Dt6BykDPdIcA1LQ6ntWeSKqAedwLTvG", "admin"),
                    ("Mark", "Martinez", "mark.martinez7@example.com", "$2y$10$.xEcAEQxrHMkINb1clN2huA7O5A2bnzr5O4HTrOEvw.nYP3.wfBLO", "teacher"),
                    ("Lisa", "Miller", "lisa.miller8@example.com", "$2y$10$HYMGUJujzQ24.Uh9c9cEv.oRZAnGQJAfP1nGJjfb7v9T6N0GjIYle", "student"),
                    ("David", "Rodriguez", "david.rodriguez9@example.com", "$2y$10$roTWugSglbiBF07fykT1YOM4s7DCb.evmYX2V69VbmcRj2Eh9iB16", "student"),
                    ("Sophia", "Wilson", "sophia.wilson10@example.com", "$2y$10$5vlPdD/b5CNL.KH9hX1B.ux2NQqFoX7MJg9Q5Ky/ALiqnZQJ29PRK", "teacher"),
                    ("Ethan", "Moore", "ethan.moore11@example.com", "$2y$10$dpUE4GE83oL7zVClXx1ZreFVUGRRJOF16gsT3M98QgjGzGf.oAJFC", "admin"),
                    ("Olivia", "Taylor", "olivia.taylor12@example.com", "$2y$10$aQiVpVLRJbWbbOeNaJhVyO/HH.KWtGZdd3RM2Hc/CRBqRxf/vDrhS", "student"),
                    ("James", "Anderson", "james.anderson13@example.com", "$2y$10$N1JYY8.cM53f95V3uxZYxO8x7Kdo7Erh9FgGMFaMoSnpDpVtM8Pxm", "teacher"),
                    ("Mia", "Thomas", "mia.thomas14@example.com", "$2y$10$7bF6goRdNjTI1ibmHvc2g.IkbnYktosMZby1RQeqLqxzWti9PtTym", "student"),
                    ("Noah", "Jackson", "noah.jackson15@example.com", "$2y$10$Na8g0UwO34YWfgN9BX3.cu1ExlEw6OBNNKRph6z7ksE0RgqxxbHPy", "admin"),
                    ("Isabella", "White", "isabella.white16@example.com", "$2y$10$DaM.bVSeZVxfYHtQZWqx4e1bz5HsA3Z5N5WY6sTka3AWQoEunIXmW", "teacher"),
                    ("Liam", "Harris", "liam.harris17@example.com", "$2y$10$SyafkmMmHLtOhwd0oUmvoe7z.YFt.kNQQnSxh.vy1/PtxiEzdlFgi", "student"),
                    ("Ava", "Martin", "ava.martin18@example.com", "$2y$10$Bq5VQGe2G/AGI4h8R1HFTOQ0RpZmzZ8UuYRV37PRDHU/oXecZGmZC", "student"),
                    ("Lucas", "Thompson", "lucas.thompson19@example.com", "$2y$10$Xfz45I3RHGxS7phgGHOck.iFwCN1lgzp7nN8o7xRnFJq42dOrOEeS", "teacher"),
                    ("Charlotte", "Garcia", "charlotte.garcia20@example.com", "$2y$10$PZVqA5fXfu4OGfOhakUwZevB6yOL0vjLSRPbQuIpl1P9EtcB/z7te", "admin"),
                    ("Benjamin", "Lopez", "benjamin.lopez21@example.com", "$2y$10$OY3Kd95bsBzi0Lw0fWi4xuLdH5X8moM9rElGoKeerIGcME4e.WMiy", "student"),
                    ("Amelia", "Clark", "amelia.clark22@example.com", "$2y$10$QeE7FZ.TAjf27U1dhbVDSuIoQl6h9oCsblka8uMcCxrGRkzAzbAGu", "teacher"),
                    ("Henry", "Lee", "henry.lee23@example.com", "$2y$10$ISvcpB7KZjI3tAmAIdAU.eFX8qNVOz6kdoyGMFp4SfqsQKz9uzxyu", "student"),
                    ("Ella", "Lewis", "ella.lewis24@example.com", "$2y$10$NoK0bGgDNsnDTCBhQPO/MeQ9GbCC9/dMOXMJOs4aXeRMBv10LQUQm", "admin"),
                    ("Sebastian", "Walker", "sebastian.walker25@example.com", "$2y$10$5xVo.wRm/HCDcpbOqKP4.eN8yRZaZz1z2jBWR.lf6CQr7QiayLtDK", "teacher"),
                    ("Grace", "Hall", "grace.hall26@example.com", "$2y$10$AwOON0HaI91xFSxzQegA7uZ6kE6gQg4/T98HKHEflXDYwAldG6miK", "student"),
                    ("Alexander", "Young", "alexander.young27@example.com", "$2y$10$IE/2T7gGMRUFeZmHECZxvOr8sLgyokpPhPOx6ugL/cy7lGmERm7i.", "admin"),
                    ("Zoe", "King", "zoe.king28@example.com", "$2y$10$SxiPRPbpxrBCYoRRRXP1beBcsCdpVtT1cdVb4sg4QJDxJujVbx5JG", "student"),
                    ("Daniel", "Scott", "daniel.scott29@example.com", "$2y$10$8n.Vq0XeH1GB/OuLf7Jb0eEt/XClDhTLGttHcMEUKbyzxEwyxMoNy", "teacher"),
                    ("Abigail", "Green", "abigail.green30@example.com", "$2y$10$F/EF/N8tG8nFmBQ7T/gqP.TtTAh1zKmIgCwTn3Js0F5J09c5VQByC", "student"),
                    ("Matthew", "Baker", "matthew.baker31@example.com", "$2y$10$XhxHiA2Qp1cczBCSe0y4EuIWcaVVrAIUNOWpOMpvlgYX2QfFhMZZa", "teacher"),
                    ("Harper", "Gonzalez", "harper.gonzalez32@example.com", "$2y$10$X53.yrHdUspMvBOxGBdBQeXZ/ZCWimrH5ADFnNyJlHCUu0jxlzNHi", "admin"),
                    ("Jackson", "Adams", "jackson.adams33@example.com", "$2y$10$MOmBx/pz9ETp6pT5AwL9Eu79NC.kgxzvXBFO9Ki.oVEjcBXmr4lWO", "student"),
                    ("Lily", "Nelson", "lily.nelson34@example.com", "$2y$10$P9voTjHJotox9oaD4fnbXOLrnAWMmrNz9JUMRzAv1Q8M10BQz/Z5a", "teacher"),
                    ("Owen", "Carter", "owen.carter35@example.com", "$2y$10$dwUKBZQfPYFSF3ZZphOXTubdsvBfScc0IlZoCO0rTffD/4y2J0NMW", "admin"),
                    ("Sofia", "Mitchell", "sofia.mitchell36@example.com", "$2y$10$rIXPv0BPRxeW76OPcdlA2ONd.nV7QqRJJH6CLMRXt7Eq3DgphlxkK", "student"),
                    ("Aiden", "Perez", "aiden.perez37@example.com", "$2y$10$ZBptpHSkiPMB/EsvOZqAVONFAzbiWceDfy1G2n0NdBOCpzdsCt9Qu", "teacher"),
                    ("Evelyn", "Roberts", "evelyn.roberts38@example.com", "$2y$10$/zCKjb1ON1pdXoh7ePOMfuEp6OWAF3q/UZzvoLMnpYjFuvCifNf5i", "student"),
                    ("Caleb", "Turner", "caleb.turner39@example.com", "$2y$10$D.QYvLaOYECob/ZgyS.m.eoofZzNcPHBDRMyom.6bHi/Tu9DzpZ2O", "admin"),
                    ("Mila", "Phillips", "mila.phillips40@example.com", "$2y$10$uJxrJrnNnFFMzkB2dA/Aj.4QLZZLPzvN6.ZXTYGi9spkImtsR.J3W", "teacher"),
                    ("Levi", "Campbell", "levi.campbell41@example.com", "$2y$10$LO.1/ROeZHr3Jw0lMBG.oExx1K8JdfSwpDNMSh6VnT7UAEK9DpWia", "student"),
                    ("Ella", "Parker", "ella.parker42@example.com", "$2y$10$pNC7Z5NdZORITt1xTMvO7uQn7VGBZCmKAI.IbHxaxMGzo3kmIdmDW", "teacher"),
                    ("Mason", "Evans", "mason.evans43@example.com", "$2y$10$a6QQXKJ0IKsPA/sN9kTFmecTRtr/HUmX1TFxkY1EO0UnmIthgJXAi", "student"),
                    ("Avery", "Edwards", "avery.edwards44@example.com", "$2y$10$n8oMnoQhuSRm9SLq7IHybefxuG2ER4Ot7gTHpUvGfnVV2UKEkMLOK", "admin"),
                    ("Scarlett", "Collins", "scarlett.collins45@example.com", "$2y$10$YXfzkXeIZJY7j9PRT4WvVOsfuRIT/7gBY47f.XkFZXx.hIfT8mH3m", "student"),
                    ("Elijah", "Stewart", "elijah.stewart46@example.com", "$2y$10$LDh3rXB0B8KzdpbP8w7cF.DFgSzrc5GfNsCWlAiBeTx7wxOf1/BYm", "teacher"),
                    ("Victoria", "Sanchez", "victoria.sanchez47@example.com", "$2y$10$sAx9J7XnxHnIoKe/j.lQsOg7gZBXAKdswHWhzpjmB8b9qMc2DS2kK", "admin"),
                    ("Jacob", "Morris", "jacob.morris48@example.com", "$2y$10$f8xeIK9FdxNr1f8jHGgjqO.daf0JRP6IHjyo9b7aQt5hRSh3Q9T.u", "student"),
                    ("Aria", "Reed", "aria.reed49@example.com", "$2y$10$D.yrHJ.XR2FoCjFmEYFNYexzWECuHL5Alp2Db2a0LhL4W0M0sHG2i", "teacher"),
                    ("Logan", "Sanders", "logan.sanders50@example.com", "$2y$10$VTVmDdjHhRbHFb2FGSeNkOVDglgG1RiNhKlBBIa.F7OFtHv8Fu4M6", "student");';
        
        $this->pdo->exec($sql);
    }
}
?>