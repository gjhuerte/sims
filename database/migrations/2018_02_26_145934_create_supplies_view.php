<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            SELECT distinct
                supplies.id AS id,
                supplies.stocknumber AS stocknumber,
                ifnull((
                    select avg(receipts_supplies.unitcost)
                    from receipts_supplies
                    where receipts_supplies.supply_id = supplies.id
                ), 0) as unitcost,
                supplies.details AS details,
                units.id AS unit_id,
                units. NAME AS unit_name,
                supplies.reorderpoint AS reorderpoint,
                (
                    SELECT
                        ifnull(balance_quantity, 0)
                    FROM
                        stockcards
                    WHERE
                        supplies.id = stockcards.supply_id
                    ORDER BY
                        date DESC,
                        created_at DESC,
                        id DESC
                    LIMIT 1
                ) AS stock_balance,
                ifnull((
                    SELECT
                        balance_quantity
                    FROM
                        ledgercards
                    WHERE
                        supplies.id = ledgercards.supply_id
                    ORDER BY
                        date DESC,
                        created_at DESC,
                        id DESC
                    LIMIT 1
                ), 0) AS ledger_balance,
                ifnull(
                    (
                        SELECT
                            ifnull(balance_quantity, 0)
                        FROM
                            stockcards
                        WHERE
                            supplies.id = stockcards.supply_id
                        ORDER BY
                            date DESC,
                            created_at DESC,
                            id DESC
                        LIMIT 1
                    ) - ifnull((
                        SELECT
                            sum(
                                requests_supplies.quantity_issued
                            )
                        FROM
                            requests_supplies
                        JOIN requests ON requests.id = requests_supplies.request_id
                        WHERE
                            supplies.id = requests_supplies.supply_id
                        AND requests. STATUS IN ('approved', 'Approved')
                    ), 0),
                    0
                ) AS temp_balance
            FROM
                supplies
            JOIN stockcards ON supplies.id = stockcards.supply_id
            JOIN units ON units.id = supplies.unit_id
            ORDER BY
                supplies.stocknumber 
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS supplies_v");
    }
}
