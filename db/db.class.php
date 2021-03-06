<?php
/**
 * Basic class for communication between app and database.
 */
class db
{

    private $connection = null;
    private $logger;

    /** Constructor of database connection */
    public function __construct()
    {
        $this->logger =  Logger::getLogger("db");
        $this->logger->info("DB object constructed");
    }

    /**
     * Connect to selected database type.
     * @see DB_TYPE at conf/config.inc.php
     */
    public function Connect()
    {
        if (DB_TYPE == 'mysql') {
            $this->logger->info("Try to connect MySQL database");
            try {
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
                $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE_NAME . "", DB_USER_LOGIN, DB_USER_PASSWORD, $options);
            } catch (PDOException $e) {
                $this->logger->error("PDO Exception " . $e->getMessage());
                $message = "Error!: " . $e->getMessage() . "<br/>";
                debugPrint($message);
                die();
            }
        } elseif (DB_TYPE == 'pgsql') {
            $this->logger->info("Try to connect PgSQL database");
            $message = "PgSQL connectivity is NOT implemented";
            debugPrint($message);
            die();
        } else {
            $this->logger->error("Try to connect UNKNOWN type of database");
            $message = "Unknown database type. This type " . DB_TYPE . " is NOT implemented";
            debugPrint($message);
            die();
        }
    }

    /**
     * Close database connection.
     */
    public function disconnect()
    {
        $this->connection = null;
    }

    /**
     * Returns PDO connection to database
     * @return PDO connection to database
     */
    public function getConnection()
    {
        return $this->connection;
    }

    // ****************************************************************************************************************
    // START UNIVERSAL METHODS

    /**
     * Nacist 1 zaznam z tabulky v DB.
     *
     * @param string $table_name - jm�no tabulky
     * @param string $select_columns_string - jm�na sloupc� odd�len� ��rkami, nebo jin� p��kazy SQL
     * @param array $where_array - seznam podm�nek<br/>
     * 							[] - column = sloupec; value - int nebo string nebo value_mysql = now(); symbol
     * @param string $limit_string - doplnit limit string
     * @return array[]
     */
    public function DBSelectOne($table_name, $select_columns_string, $where_array, $limit_string = "")
    {
        //////printr($where_array);

        // vznik chyby v PDO
        $mysql_pdo_error = false;

        // slozit si podminku s otaznikama
        $where_pom = "";

        if ($where_array != null)
            foreach ($where_array as $index => $item)
            {
                // pridat AND
                if ($where_pom != "") $where_pom .= "AND ";

                $column = $item["column"];
                $symbol = $item["symbol"];

                if (key_exists("value", $item))
                    $value_pom = "?"; 						// budu to navazovat
                else if (key_exists("value_mysql", $item))
                    $value_pom = $item["value_mysql"]; 		// je to systemove, vlozit rovnou - POZOR na SQL injection, tady to muze projit
                else $value_pom = "";

                $where_pom .= "`$column` $symbol  $value_pom ";
            }

        // doplnit slovo where
        if (trim($where_pom) != "") $where_pom = "where $where_pom";

        // 1) pripravit dotaz s dotaznikama
        $query = "select $select_columns_string from `".$table_name."` $where_pom $limit_string;";
        //////echo "$query <br/>";
        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);

        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;

        if ($where_array != null)
            foreach ($where_array as $index => $item)
            {
                if (key_exists("value", $item))
                {
                    $value = $item["value"];
                    //////echo "navazuju value: $value jako number: $bind_param_number";

                    $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                    $bind_param_number ++;
                }
            }

        // 4) provest dotaz
        $statement->execute();

        // 5) kontrola chyb
        $errors = $statement->errorInfo();

        if ($errors[0] + 0 > 0)
        {
            // nalezena chyba
            $mysql_pdo_error = true;
        }

        // 6) nacist data a vratit
        if ($mysql_pdo_error == false)
        {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        else
        {
            $this->logger->error("Error in statement execution: " . $errors[2]);
            $this->logger->info("Error query: " . $query);
            return false;
        }
    }


    /** ****************************************************************************************************************
     * Nacist vsechny zaznamy z tabulky.
     * Poznamka: tato metoda je stejna jako DBSelectOne - lisi se to jen posledni casti Fetch vs FetchAll
     *
     * @param string $table_name
     * @param string $select_columns_string
     * @param array $where_array
     * @param string $limit_string
     * @param array			$order_by_array - pouze pole stringu: [0] => {[column] = "", [sort] => "DESC"}
     * @return mixed
     */
    public function DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string = "", $order_by_array = array())
    {
        // PDO - MySQL

        //////echo "metoda DBSelectAll";
        //////printr($this->connection);
        //exit;

        // vznik chyby v PDO
        $mysql_pdo_error = false;

        // slozit si podminku s otaznikama
        $where_pom = "";

        if ($where_array != null)
            foreach ($where_array as $index => $item)
            {
                // pridat AND
                if ($where_pom != "") $where_pom .= "AND ";

                // pokud neexistuje klic column, tak preskocit
                if (!key_exists("column", $item))
                {
                    ////echo "asi chyba v metode DBSelectAll - chybi klic column <br/>";
                    continue;
                }

                $column = $item["column"];					// pozor na column, mohlo by projit SQL injection
                $symbol = $item["symbol"];

                if (key_exists("value", $item))
                    $value_pom = "?"; 						// budu to navazovat
                else if (key_exists("value_mysql", $item))
                    $value_pom = $item["value_mysql"]; 		// je to systemove, vlozit rovnou - POZOR na SQL injection, tady to muze projit
                else
                    $value_pom = "";

                //////echo "`$column` $symbol  $value_pom ";
                $where_pom .= "`$column` $symbol  $value_pom ";
            }

        // doplnit slovo where
        if (trim($where_pom) != "") $where_pom = "where $where_pom";


        // pridat si order by - musim to tam dat primo, nelze to dat do prepared statements
        $order_by_pom = "";

        if ($order_by_array != null)
            foreach ($order_by_array as $index => $item)
            {
                $column = $item["column"];
                $sort = $item["sort"];

                // carku pred
                if (trim($order_by_pom != null))
                    $order_by_pom .= ", ";

                $order_by_pom .= "`$column` $sort";
            }

        // doplnit slovo order by
        if (trim($order_by_pom) != "") $order_by_pom = "order by $order_by_pom";


        // 1) pripravit dotaz s dotaznikama
        $query = "select ".$select_columns_string." from `".$table_name."` $where_pom $order_by_pom $limit_string;";
        //////echo $query;

        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);

        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;

        if ($where_array != null)
            foreach ($where_array as $index => $item)
            {
                if (key_exists("value", $item))
                {
                    $value = $item["value"];
                    //////echo "navazuju value: $value";

                    $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                    $bind_param_number ++;
                }
            }
//********************/
        // ////printr($statement);
        // 4) provest dotaz
        $statement->execute();

        // 5) kontrola chyb
        $errors = $statement->errorInfo();

        if ($errors[0] + 0 > 0)
        {
            // nalezena chyba
            $mysql_pdo_error = true;
        }

        // 6) nacist data a vratit
        if ($mysql_pdo_error == false)
        {
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
        else
        {
            $this->logger->error("Error in statement execution: " . $errors[2]);
            $this->logger->info("Error query: " . $query);
            return null;
        }
    }

    /** ****************************************************************************************************************
     *
     * Pridat polozku do DB - zakladni verze bez mysl fci typu now().
     * @param string $table_name
     * @param array $item - musi byt ve stejne podobe jako DB.
     * @return bool if insert was successful
     * */
    public function DBInsert($table_name, $item)
    {
        $mysql_pdo_error = false;

        // SLOZIT TEXT STATEMENTU s otaznikama
        $insert_columns = "";
        $insert_values  = "";

        if ($item != null)
            foreach ($item as $column => $value)
            {
                // pridat carky
                if ($insert_columns != "") $insert_columns .= ", ";
                if ($insert_columns != "") $insert_values .= ", ";

                $insert_columns .= "`$column`";
                $insert_values .= "?";
            }

        // 1) pripravit dotaz s dotaznikama
        $query = "insert into `$table_name` ($insert_columns) values ($insert_values);";

        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);

        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;

        if ($item != null)
            foreach ($item as $column => $value)
            {
                $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                $bind_param_number ++;
            }

        // 4) provest dotaz
        $statement->execute();

        // 5) kontrola chyb
        $errors = $statement->errorInfo();

        if ($errors[0] + 0 > 0)
        {
            // nalezena chyba
            $mysql_pdo_error = true;
        }

        // 6) nacist ID vlozeneho zaznamu a vratit
        if ($mysql_pdo_error == false)
        {
            $item_id = $this->connection->lastInsertId();
            return true;
        }
        else
        {
            $this->logger->error("Error in statement execution: " . $errors[2]);
            $this->logger->info("Error query: " . $query);
            return false;
        }
    }


    /** ****************************************************************************************************************
     * Pridat polozku do DB - rozsirena verze.
     *
     * @param string $table_name
     * @param array $item - column = sloupec; value - int nebo string nebo value_mysql
     */
    public function DBInsertExpanded($table_name, $item)
    {
        // MySql
        // SLOZIT TEXT STATEMENTU s otaznikama
        $insert_columns = "";
        $insert_values  = "";
        if ($item != null)
            foreach ($item as $row)
            {
                // pridat carky
                if ($insert_columns != "") $insert_columns .= ", ";
                if ($insert_columns != "") $insert_values .= ", ";
                $column = $row["column"];
                if (key_exists("value", $row))
                    $value_pom = "?"; 						// budu to navazovat
                else if (key_exists("value_mysql", $row))
                    $value_pom = $row["value_mysql"]; 		// je to systemove, vlozit rovnou - POZOR na SQL injection, tady to muze projit
                $insert_columns .= "`$column`";
                $insert_values .= "$value_pom";
            }
        // 1) pripravit dotaz s dotaznikama
        $query = "insert into `$table_name` ($insert_columns) values ($insert_values);";
        // ////echo $query;
        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);
        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;
        if ($item != null)
            foreach ($item as $row)
            {
                if (key_exists("value", $row))
                {
                    $value = $row["value"];
                    //////echo "navazuju value: $value";
                    $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                    $bind_param_number ++;
                }
            }
        // 4) provest dotaz
        $statement->execute();
        // 5) kontrola chyb
        $errors = $statement->errorInfo();

        if ($errors[0] + 0 > 0)
        {
            // nalezena chyba
            $mysql_pdo_error = true;
        }
        // 6) nacist ID vlozeneho zaznamu a vratit
        if ($mysql_pdo_error == false)
        {
            $item_id = $this->connection->lastInsertId();
            return $item_id;
        }
        else
        {
            $this->logger->error("Error in statement execution: " . $errors[2]);
            $this->logger->info("Error query: " . $query);
            return false;
        }
    }

    /** ****************************************************************************************************************
     * @param $table_name
     * @param $item
     * @param $where_str
     * @param $limit_string
     * @return bool if update was successful
     */
    public function DBUpdate($table_name, $item, $where_str, $limit_string)
    {
        // MySql
        $mysql_pdo_error = false;
        // SLOZIT TEXT STATEMENTU s otaznikama
        $insert_data = "";
        if ($item != null)
            foreach ($item as $column => $value)
            {
                // pridat carky
                if ($insert_data != "") $insert_data .= ", ";
                $insert_data .= "`$column` = ?";
            }
        // 1) pripravit dotaz s dotaznikama
        $query = "update `$table_name` set $insert_data where $where_str;";
        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);
        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;
        if ($item != null)
            foreach ($item as $column => $value)
            {
                $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                $bind_param_number ++;
            }
        // 4) provest dotaz
        $statement->execute();
        // 5) kontrola chyb
        $errors = $statement->errorInfo();

        if ($errors[0] + 0 > 0)
        {
            // nalezena chyba
            $mysql_pdo_error = true;
        }
        // 6) nacist ID vlozeneho zaznamu a vratit
        if ($mysql_pdo_error == false)
        {
            return $statement->rowCount();
        }
        else
        {
            $this->logger->error("Error in statement execution: " . $errors[2]);
            $this->logger->info("Error query: " . $query);
            return false;
        }
    }


    /** ****************************************************************************************************************
     * Smazat 1 zaznam z tabulky v DB.
     *
     * @param string $table_name - jm�no tabulky
     * @param array $where_array - seznam podm�nek<br/>
     * 							[] - column = sloupec; value - int nebo string nebo value_mysql = now(); symbol
     * @param string $limit_string - doplnit limit string
     * @return array[]
     */
    public function DBDelete($table_name, $where_array, $limit_string = "")
    {
        // PDO - MySQL
        //////printr($where_array);
        // vznik chyby v PDO
        $mysql_pdo_error = false;
        // slozit si podminku s otaznikama
        $where_pom = "";
        if ($where_array != null)
            foreach ($where_array as $index => $item)
            {
                // pridat AND
                if ($where_pom != "") $where_pom .= "AND ";
                $column = $item["column"];
                $symbol = $item["symbol"];
                if (key_exists("value", $item))
                    $value_pom = "?"; 						// budu to navazovat
                else if (key_exists("value_mysql", $item))
                    $value_pom = $item["value_mysql"]; 		// je to systemove, vlozit rovnou - POZOR na SQL injection, tady to muze projit
                $where_pom .= "`$column` $symbol  $value_pom ";
            }
        // doplnit slovo where
        if (trim($where_pom) != "") $where_pom = "where $where_pom";
        // 1) pripravit dotaz s dotaznikama
        $query = "delete from `".$table_name."` $where_pom $limit_string;";
        //////echo "$query <br/>";
        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);
        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;
        if ($where_array != null)
            foreach ($where_array as $index => $item)
            {
                if (key_exists("value", $item))
                {
                    $value = $item["value"];
                    //////echo "navazuju value: $value jako number: $bind_param_number";
                    $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                    $bind_param_number ++;
                }
            }
        // 4) provest dotaz
        $statement->execute();
        // 5) kontrola chyb
        $errors = $statement->errorInfo();

        if ($errors[0] + 0 > 0)
        {
            $mysql_pdo_error = true;
        }
        // 6) nacist data a vratit
        if ($mysql_pdo_error == false)
        {
            return $statement->rowCount();
        }
        else
        {
            $this->logger->error("Error in statement execution: " . $errors[2]);
            $this->logger->info("Error query: " . $query);
            return $errors;
        }
    }

    // KONEC UNIVERZALNI METODY
    // ***********************************************************

}