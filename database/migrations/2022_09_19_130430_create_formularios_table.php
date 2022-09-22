<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('challenge_id');
            $table->text('associacao_soneca_colo')->nullable();
            $table->text('associacao_soneca_mamar')->nullable();
            $table->text('associacao_soneca_cc')->nullable();
            $table->text('associacao_soneca_rede')->nullable();
            $table->text('associacao_soneca_chupar_dedo')->nullable();
            $table->text('associacao_soneca_chupeta')->nullable();
            $table->text('associacao_soneca_naninha')->nullable();
            $table->text('associacao_soneca_ruido')->nullable();
            $table->text('associacao_sono_colo')->nullable();
            $table->text('associacao_sono_mamar')->nullable();
            $table->text('associacao_sono_cc')->nullable();
            $table->text('associacao_sono_rede')->nullable();
            $table->text('associacao_sono_chupar_dedo')->nullable();
            $table->text('associacao_sono_chupeta')->nullable();
            $table->text('associacao_sono_naninha')->nullable();
            $table->text('associacao_sono_ruido')->nullable();
            $table->text('associacao_incomoda')->nullable();
            $table->text('associacao_descricao')->nullable();
            $table->text('desacelera')->nullable();
            $table->text('ambiente_luz')->nullable();
            $table->text('ambiente_barulho')->nullable();
            $table->text('ambiente_temperatura')->nullable();
            $table->text('ritual_choro')->nullable();
            $table->text('ritual_momento')->nullable();
            $table->text('gasto_energia_ajuste')->nullable();
            $table->text('sinais_sono_ajuste')->nullable();
            $table->text('desacelerar_ajuste')->nullable();
            $table->text('ambiente_luz_ajuste')->nullable();
            $table->text('ambiente_som_ajuste')->nullable();
            $table->text('ambiente_temperatura_ajuste')->nullable();
            $table->text('ritual_sono_ajuste')->nullable();
            $table->text('ritual_bom_dia')->nullable();
            $table->text('ritual_bom_dia_outros')->nullable();
            $table->text('ajuste_rotina_sonecas')->nullable();
            $table->text('ajuste_duracao_sonecas')->nullable();
            $table->text('ajustes_despertar')->nullable();
            $table->text('ajustes_ritual_bom_dia')->nullable();
            $table->text('ajustes_fome')->nullable();
            $table->text('ajustes_dor')->nullable();
            $table->text('ajustes_dor_colica')->nullable();
            $table->text('ajustes_dor_refluxo')->nullable();
            $table->text('ajustes_dor_dentes')->nullable();
            $table->text('ajustes_salto')->nullable();
            $table->text('ajustes_angustia')->nullable();
            $table->text('ajustes_telas')->nullable();
            $table->text('telas')->nullable();
            $table->text('angustia')->nullable();
            $table->text('angustia_campo_visao')->nullable();
            $table->text('angustia_pai_atende')->nullable();
            $table->text('salto')->nullable();
            $table->text('salto_marcos')->nullable();
            $table->text('fome_pediatra')->nullable();
            $table->text('fome_peso_adequado')->nullable();
            $table->text('fome_ganho_peso')->nullable();
            $table->text('fome_urina')->nullable();
            $table->text('fome_evacuacoes')->nullable();
            $table->text('passo1_sinais_sono')->nullable();
            $table->text('passo1_ritual_sono')->nullable();
            $table->text('passo1_duracao_sonecas')->nullable();
            $table->text('ajuste_exterogestacao')->nullable();
            $table->text('passo2')->nullable();
            $table->text('passo3_despertar')->nullable();
            $table->text('passo3_rotina')->nullable();
            $table->text('passo3_pilares')->nullable();
            $table->text('passo4')->nullable();
            $table->text('comentarios')->nullable();
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
        Schema::dropIfExists('formularios');
    }
}
