<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement('
        //     CREATE VIEW rsmi_v AS
        //         SELECT st.date,st.reference ,st.office,st.stocknumber ,s.supplytype,s.unit ,st.issuequantity,NULL AS "unitprice", NULL AS "amount"
        //         FROM supplytransaction AS st 
        //             RIGHT JOIN supply AS s ON st.stocknumber = s.stocknumber 
        //             WHERE receiptquantity = 0 
        //     ');
        // DB::statement('
        // CREATE VIEW ledger_bal AS
        //     SELECT date_format(date, "%M %Y") AS "date",stocknumber,balancequantity
        //     FROM supplyledger
        //     WHERE id in (SELECT MAX(id)
        //                  FROM supplyledger
        //                  GROUP BY stocknumber,YEAR(date),MONTH(date))
        //     ');

        // DB::statement('
        // CREATE VIEW ledger_sum AS
        //     SELECT date_format(date, "%M %Y") AS "date",stocknumber,sum(receiptquantity) AS "receiptquantity",avg(receiptunitprice) AS "receiptunitprice",sum(issuequantity) AS "issuequantity",avg(issueunitprice) AS "issueunitprice"
        //     FROM supplyledger
        //     GROUP BY stocknumber,YEAR(date),MONTH(date),date_format(date, "%M %Y")
        //     ');

        // DB::statement('
        // CREATE VIEW ledger_view AS
        //     SELECT ls.date,ls.stocknumber,ls.receiptquantity,ls.receiptunitprice,ls.issuequantity,ls.issueunitprice,lb.balancequantity
        //     FROM ledger_sum as ls
        //     RIGHT JOIN ledger_bal as lb
        //     ON ls.stocknumber=lb.stocknumber and ls.date=lb.date
        //     ');

        /*DB::statement('
        create VIEW supplyledger_view AS
            SELECT DATE_FORMAT(date, "%M") AS "Date",stocknumber AS "Stock No.",reference AS "Reference",receiptquantity AS "Receipt Qty.",receiptunitprice AS "Receipt Unit Cost",issuequantity AS "Issue Qty",issueunitprice AS "Issue Unit Cost",balancequantity AS "Balance Qty.",daystoconsume AS "Days to Consume" 
            FROM supplyledger
            GROUP BY DATE_FORMAT(date, "%M");
            ');*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement('DROP VIEW rsmi_view;');
        // DB::statement('DROP VIEW ledger_sum;');
        // DB::statement('DROP VIEW ledger_bal;');
        // DB::statement('DROP VIEW ledger_view;');
        /*
        DB::statement('DROP VIEW supplyledger_view;');*/
    }
}
