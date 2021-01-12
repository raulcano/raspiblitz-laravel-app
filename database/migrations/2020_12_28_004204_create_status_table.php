<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status', function (Blueprint $table) {
            $table->id();
            
            # RASPIBLITZ INFO FILE
            # /home/admin/raspiblitz.info
            $table->string('info_state');
            $table->text('info_message');
            $table->string('info_network');
            $table->string('info_chain');
            $table->tinyInteger('info_fsexpanded');
            $table->string('info_lcd2hdmi');
            $table->tinyInteger('info_setupStep');
            $table->string('info_cpu');
            $table->string('info_baseimage');
            $table->tinyInteger('info_undervoltageReports');
    
            # RASPIBLITZ CONFIG FILE 
            # /mnt/hdd/raspiblitz.conf
            $table->string('conf_raspiBlitzVersion');
            $table->string('conf_network');
            $table->string('conf_networkUPnP');
            $table->string('conf_chain');
            $table->string('conf_hostname');
            $table->string('conf_lcd2hdmi');
            $table->tinyInteger('conf_lcdrotate');
            $table->string('conf_publicIP');
            $table->string('conf_autoPilot');
            $table->string('conf_autoNatDiscovery');
            $table->string('conf_runBehindTor');
            $table->string('conf_rtlWebinterface');
            $table->tinyInteger('conf_setnetworkname');
            $table->string('conf_lndPort');
            $table->string('conf_lndAddress');
            $table->string('conf_joinmarket');
            $table->string('conf_nodeJS');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status');
    }
}
