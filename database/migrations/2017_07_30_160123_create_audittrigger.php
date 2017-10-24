<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudittrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        DB::unprepared('
            CREATE DEFINER=`root`@`localhost` TRIGGER `insert_datasupply` BEFORE INSERT ON `supply` FOR EACH ROW 
            BEGIN 
            INSERT INTO audittable (`columnname` , `status` , `newvalue` , `date`) 
            VALUES ("stocknumber", "created", NEW.stocknumber,NOW());
            END');
        DB::unprepared('
        CREATE DEFINER=`root`@`localhost` TRIGGER `update_data` AFTER UPDATE ON `supply` FOR EACH ROW 
        BEGIN 
        IF (NEW.stocknumber != OLD.stocknumber) THEN INSERT INTO audittable (`columnname` , `status` , `oldvalue` , `newvalue`, `date`) 
        VALUES ("stocknumber", "updated", OLD.stocknumber, NEW.stocknumber,NOW()); 
        END IF; 
        IF (NEW.supplytype != OLD.supplytype) THEN INSERT INTO audittable (`columnname` , `status` , `oldvalue` , `newvalue`, `date`) 
        VALUES ("supplytype", "updated", OLD.supplytype, NEW.supplytype,NOW()); 
        END IF; 
        IF (NEW.unit != OLD.unit) THEN INSERT INTO audittable (`columnname` , `status` , `oldvalue` , `newvalue`, `data`) 
        VALUES ("unit", "update", OLD.unit, NEW.unit,NOW()); 
        END IF; 
        IF (NEW.reorderpoint != OLD.reorderpoint) THEN INSERT INTO audittable (`columnname` , `status` , `oldvalue` , `newvalue`, `date`) 
        VALUES ("reorderpoint", "updated", OLD.reorderpoint, NEW.reorderpoint,NOW()); 
        END IF; 
        END');
        DB::unprepared('
            CREATE DEFINER=`root`@`localhost` TRIGGER `delete_datasupply` BEFORE DELETE ON `supply` FOR EACH ROW 
            BEGIN 
            INSERT INTO audittable (`columnname` , `status` , `oldvalue` , `date`) VALUES ("stocknumber", "deleted", OLD.stocknumber,NOW()); END');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `insert_datasupply`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_data`;');
        DB::unprepared('DROP TRIGGER IF EXISTS `delete_datasupply`;');
    }
}
