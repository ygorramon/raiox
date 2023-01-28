<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $fillable = [
            'associacao_soneca_colo','comentarios','conclusao', 
            'ajuste_exterogestacao','associacao_soneca_mamar','associacao_soneca_cc','associacao_soneca_rede','associacao_soneca_chupar_dedo','associacao_soneca_chupeta','associacao_soneca_ruido','associacao_sono_colo','associacao_sono_mamar','associacao_sono_cc','associacao_sono_rede','associacao_sono_chupar_dedo','associacao_sono_naninha', 'associacao_sono_chupeta','associacao_sono_ruido','associacao_incomoda','associacao_descricao','desacelera','ambiente_luz','ambiente_barulho','ambiente_temperatura','desacelera_sinais','ritual_choro','ritual_momento','gasto_energia_ajuste','sinais_sono_ajuste','desacelerar_ajuste','ambiente_luz_ajuste','ambiente_som_ajuste','ambiente_temperatura_ajuste','ritual_sono_ajuste','ritual_bom_dia','ritual_bom_dia_outros','ajustes_despertar','ajustes_ritual_bom_dia','ajustes_fome','ajustes_dor','ajustes_dor_colica','ajustes_dor_refluxo','ajustes_dor_dentes','ajustes_salto','ajustes_angustia','ajustes_telas','telas','angustia','angustia_campo_visao','angustia_pai_atende','angustia_pai_atende','salto','salto_marcos','fome_pediatra','fome_peso_adequado','fome_ganho_peso','fome_urina','fome_evacuacoes','passo1_sinais_sono','passo1_ritual_sono','passo1_duracao_sonecas','passo2', 'passo3_despertar', 'passo3_rotina', 'passo3_pilares', 'passo4'];
}
