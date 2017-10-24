<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudittableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audittable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('columnname',150); 
            $table->string('status',150); 
            $table->string('oldvalue',150)->nullable(); 
            $table->string('newvalue',150)->nullable();
            $table->datetime('date');
            });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('audittable');
    }
}

/*
DROP TRIGGER IF EXISTS trg_overdue_loans;
DELIMITER $$    
CREATE TRIGGER `trg_overdue_loans` AFTER UPDATE ON loan FOR EACH ROW
    BEGIN   
        IF NEW.return_date > OLD.due_date THEN 
         INSERT INTO overdue (student_num, out_date, due_date, return_date)
         VALUES (OLD.student_num, OLD.out_date, OLD.due_date, NEW.return_date);
        END IF;
    END;$$
DELIMITER ;
*/

/*
DELIMITER $$

DROP TRIGGER `update_data `$$

CREATE TRIGGER `update_data` AFTER UPDATE on `data_table`
FOR EACH ROW
BEGIN
    IF (NEW.field1 != OLD.field1) THEN
        INSERT INTO data_tracking 
            (`data_id` , `field` , `old_value` , `new_value` , `modified` ) 
        VALUES 
            (NEW.data_id, "field1", OLD.field1, NEW.field1, NOW());
    END IF;
    IF (NEW.field2 != OLD.field2) THEN
        INSERT INTO data_tracking 
            (`data_id` , `field` , `old_value` , `new_value` , `modified` ) 
        VALUES 
            (NEW.data_id, "field2", OLD.field2, NEW.field2, NOW());
    END IF;
    IF (NEW.field3 != OLD.field3) THEN
        INSERT INTO data_tracking 
            (`data_id` , `field` , `old_value` , `new_value` , `modified` ) 
        VALUES 
            (NEW.data_id, "field3", OLD.field3, NEW.field3, NOW());
    END IF;
END$$

DELIMITER ;
*/

/*
mysql> CREATE TABLE account (acct_num INT, amount DECIMAL(10,2));
Query OK, 0 rows affected (0.03 sec)

mysql> CREATE TRIGGER ins_sum BEFORE INSERT ON account
       FOR EACH ROW SET @sum = @sum + NEW.amount;
*/

/*
IF (NEW.stocknumber != OLD.stocknumber) THEN
INSERT INTO audittable 
(`columnname` , `action` , `oldvalue` , `newvalue`) 
VALUES 
("stocknumber", "update", OLD.stocknumber, NEW.stocknumber)
END IF

IF (NEW.fundcluster != OLD.fundcluster) THEN
INSERT INTO audittable 
(`columnname` , `action` , `oldvalue` , `newvalue`) 
VALUES 
("fundcluster", "update", OLD.fundcluster, NEW.fundcluster)
END IF

IF (NEW.supplytype != OLD.supplytype) THEN
INSERT INTO audittable 
(`columnname` , `action` , `oldvalue` , `newvalue`) 
VALUES 
("supplytype", "update", OLD.supplytype, NEW.supplytype)
END IF

IF (NEW.unit != OLD.unit) THEN
INSERT INTO audittable 
(`columnname` , `action` , `oldvalue` , `newvalue`) 
VALUES
("unit", "update", OLD.unit, NEW.unit)
END IF

IF (NEW.unitprice != OLD.unitprice) THEN
INSERT INTO audittable 
(`columnname` , `action` , `oldvalue` , `newvalue`) 
VALUES 
("unitprice", "update", OLD.unitprice, NEW.unitprice)
END IF

IF (NEW.reorderpoint != OLD.reorderpoint) THEN
INSERT INTO audittable 
(`columnname` , `action` , `oldvalue` , `newvalue`) 
VALUES 
("reorderpoint", "update", OLD.reorderpoint, NEW.reorderpoint)
END IF
*/