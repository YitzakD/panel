<?php

#	HTML2PDF Needs
require ROOT . DS . 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

$item = find_one("bills", "id", $ID);

$facture = find_one("pformas", "id", $item->p_id);

$client = find_one("clients", "id", $item->client_id);

$filename = "Informations-FACTURE-$facture->pf_id-($client->e_name).pdf";

ob_start();

?>

<style type="text/css">

    table.table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    table.table-stripped {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    table.table-invoice {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        border-collapse: collapse;
    }
    table thead {
        display: table-header-group;
        vertical-align: middle;
        border-color: inherit;
    }
    table thead th {
        vertical-align: bottom;
        border-bottom: .5px solid #333333;
        border-top: .5px solid #333333;
        border-left: .5px solid #333333;
        border-right: .5px solid #333333;
        background-color: #F7F7F7;
    }
    table td, table th {
        vertical-align: top;
        padding: 12px 10px;
    }
    table.table-invoice td,
    table.table-invoice th {
        padding: 8px 10px;
    }


    table .document-title {
        font-size: 30px;
        color: #39B54A;
        vertical-align: top;
    }
    table .header-title {
        font-size: 22px;
        color: #48465B;
        vertical-align: top;
    }

    table .empty-table {
        background-color: #DEE2E6;
        font-weight: 600;
    }

    table {cellspacing: 0; width: 100%;}
    
    table td.bolder {font-weight: bold;}
    table td.italic {font-style: italic;}
    
    table td.text-center {text-align: center;}
    table td.text-right,
    table th.text-right {text-align: right;}
    
    table td.text-uppercase,
    table th.text-uppercase {text-transform: uppercase;}
    table td.text-capitalize {text-transform: capitalize;}
    
    table td.ts-zx {font-size: 13px;}
    table td.ts-1x {font-size: 15px;}
    table td.ts-2x {font-size: 18px;}
    table td.ts-3x {font-size: 25px;}
    table td.ts-4x {font-size: 30px;}

    table .ts-0x {font-size: 11px;}
    table .ts-zx {font-size: 13px;}
    table .ts-1x {font-size: 15px;}
    table .ts-2x {font-size: 18px;}

    table .text-danger {color: #E74C3C;}
    table .text-orange {color: #F15624;}
    table .text-green {color: #39B54A;}
    table .text-grey {color:#898989;}
    
    table .text-uppercase {text-transform: uppercase;}
    table .text-capitalize {text-transform: capitalize;}

    table.mt-1 {margin-top: 5px;}
    table.mt-2 {margin-top: 10px;}
    table.mt-3 {margin-top: 15px;}
    table.mt-4 {margin-top: 20px;}
    table.mt-5 {margin-top: 30px;}
    table.mt-6 {margin-top: 50px;}

    table.mb-1 {margin-bottom: 5px;}
    table.mb-2 {margin-bottom: 10px;}
    table.mb-3 {margin-bottom: 15px;}
    table.mb-4 {margin-bottom: 20px;}
    table.mb-5 {margin-bottom: 30px;}
    table.mb-6 {margin-bottom: 50px;}

    table .borderblack {border:.5px solid #333333;}
    table .borderleft {border-left:.5px solid #333333;}
    table .borderright {border-right:.5px solid #333333;}
    table .bordertop {border-top:.5px solid #333333;}
    table .borderbottom {border-bottom:.5px solid #333333;}

    table .box-p-3 {padding: 10px 7px;}
    table .box-p-2 {padding: 5px 7px;}
    table .box-p-1 {padding: 3px 0;}

    table .bg-green {
        background-color:#39B54A; 
        border:.5px solid #39B54A; 
        color:#FFFFFF;
    }
    table .bg-orange {
        background-color:#F15624; 
        border:.5px solid #F15624; 
        color:#FFFFFF;
    }
    table .bg-soft-grey {
        background-color:#CCCCCC;
        border-color: #CCCCCC;
    }
    table .bg-soft-grey-2x {
        background-color:#EEEEEE;
        border-color: #EEEEEE;
    }
    table .bg-soft-grey-zx {
        background-color:#F7F7F7;
        border-color: #F7F7F7;
    }
    table .bg-striped {
        border-top: 1px solid #DEE2E6;
        border-bottom: 1px solid #DEE2E6;
        background-color:#ECF0F1;
    }

    table .box-h-1 {height:20px;}
    table .box-h-2 {height:30px;}
    table .box-h-3 {height:50px;}
    table .box-h-4 {height:100px;}
    table .box-h-5 {height:150px;}
    table .box-h-6 {height:200px;}
    table .box-h-7 {height:250px;}
    table .box-h-6 {height:300px;}

    table#mytable {
        width: 100%;
        color: #404041;
        border-collapse: collapse;
        font-size: .83rem;
    }

    table td {width: 100%;}
    table td.box-5 {width:5%;}
    table td.box-7 {width:7%;}
    table td.box-10 {width:10%;}
    table td.box-12 {width:12%;}
    table td.box-13 {width:13%;}
    table td.box-15 {width:15%;}
    table td.box-17 {width:17%;}
    table td.box-20 {width:20%;}
    table td.box-21 {width:21%;}
    table td.box-22 {width:22%;}
    table td.box-25 {width:25%;}
    table td.box-30 {width:30%;}
    table td.box-31 {width:31%;}
    table td.box-33 {width:33.33%;}
    table td.box-35 {width:35%;}
    table td.box-40 {width:40%;}
    table td.box-43 {width:43%;}
    table td.box-45 {width:45%;}
    table td.box-46-5 {width:46.5%;}
    table td.box-50 {width:50%;}
    table td.box-52 {width:52%;}
    table td.box-55 {width:55%;}
    table td.box-57 {width:57%;}
    table td.box-60 {width:60%;}
    table td.box-65 {width:65%;}
    table td.box-70 {width:70%;}
    table td.box-73 {width:73%;}
    table td.box-75 {width:75%;}
    table td.box-78 {width:78%;}
    table td.box-80 {width:80%;}
    table td.box-83 {width:83%;}
    table td.box-85 {width:85%;}
    table td.box-90 {width:90%;}
    table td.box-92 {width:92%;}
    table td.box-93 {width:93%;}
    table td.box-95 {width:95%;}
    table td.box-97 {width:97%;}

</style>

<page backtop="5mm" backleft="10mm" backright="10mm" backbottom="5mm">

	<table id="mytable" class="mb-6">
		
		<tbody><tr><td class="box-h-5"></td></tr></tbody>

	</table>

    
    <table id="mytable" class="mb-3">

        <tbody>

        <tr>

            <td class="box-50 bordertop">

                <span class="text-uppercase">Date</span><br>
                <span class="text-grey"><?= date('j/n/Y ',strtotime(date('Y-m-d'))); ?></span>

            </td>

            <td class="box-50 bordertop text-right">

                <span class="text-uppercase">Destinataire</span><br>
                <span class="text-grey">
                    <span class="text-uppercase"><?= $client->e_name; ?></span><br>
                    <small><?= 'NCC° <b>' . $client->cc . '</b><br>' . $client->bp; ?></small>
                </span>

            </td>

        </tr>

        </tbody>

    </table>


    <table class="table-invoice">
        
        <thead>

        <tr>

            <th scope="col">QTE</th>

            <th scope="col">DESIGNATION</th>

            <th scope="col">TARIF HT / MOIS</th>

            <th scope="col">AP. REMISE</th>

            <th scope="col" class="text-right">MONTANT</th>

        </tr>

        </thead>

       <tbody>

        <tr>

            <td class="box-5 borderright"><?=$facture->sb_count ?></td>
            
            <td class="box-45 borderright">Location d'espace publicitaire de panneau(x) <?=$facture->sb_size . 'm²'; ?></td>

            <td class="box-15 borderright"><?= number_format($facture->one_ht_price, 0, '', '.'); ?></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 text-right"><?= number_format($this_price =(($facture->one_ht_price *$facture->sb_count) *$facture->nb_month), 0, '', '.'); ?></td>

        </tr>

        <tr>

            <td class="box-5 borderright"></td>
            
            <td class="box-45 borderright">Type : <?=$facture->screen_type; ?></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 text-right"></td>

        </tr>

        <tr>

            <td class="box-5 borderright"></td>
            
            <td class="box-45 borderright">Durée : <?= $facture->letter_time . ' (' . $facture->numeric_time . ') ' . 'jours'; ?></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 text-right"></td>

        </tr>

        <tr>

            <td class="box-5 borderright"></td>
            
            <td class="box-45 borderright">Période : <?= date('j/n/Y ',strtotime($facture->debut)) . ' - ' . date('j/n/Y ',strtotime($facture->fin)); ?></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 text-right"></td>

        </tr>

        <tr>

            <td class="box-5 borderright"></td>
            
            <td class="box-45 borderright">Remise eceptionelle : <?=$facture->remised; ?></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"><?= number_format($facture->one_stoped_price, 0, '', '.'); ?></td>

            <td class="box-15 text-right"><?= number_format($facture->ht_price, 0, '', '.'); ?></td>

        </tr>
        
        <?php if($facture->agency_remised === "Oui"): ?>
        <tr>

            <td class="box-5 borderright"></td>
            
            <td class="box-45 borderright">Commission agence 15% : <?=$facture->agency_remised; ?></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 text-right"><?= number_format($facture->agency_remised_ht_price, 0, '', '.'); ?></td>

        </tr>
        <?php endif; ?>
                            
        <?php if($facture->int_city_count > 0): ?>
        <tr>

            <td class="box-5 borderright"><?=$facture->int_city_count; ?></td>
            
            <td class="box-45 borderright">Transport intérieur (75 000 F/Ville)</td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"></td>

            <td class="box-15 text-right"><?= number_format($facture->transport_price, 0, '', '.'); ?></td>

        </tr>
        <?php endif; ?>

        <tr><td colspan="5"></td></tr>
                            
        <?php if($facture->alcool_type === "Oui"): ?>
        <tr>

            <td class="box-5 borderright"><?=$facture->sb_count; ?></td>
            
            <td class="box-45 borderright">TM - ALCOOL (2000/m²/Mois)</td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"><?= number_format((2000 *$facture->sb_size), 0, '', '.'); ?></td>

            <td class="box-15 text-right"><?= number_format($facture->tm_alcool_amount, 0, '', '.'); ?></td>

        </tr>
        <?php endif; ?>

        <?php if($facture->odp === "Oui" &&$facture->odp_amount > 0): ?>
            <?php if($facture->alcool_type === "Non" &&$facture->tm_amount > 0): ?>
            <tr>

                <td class="box-5 borderright"><?=$facture->sb_count; ?></td>
                
                <td class="box-45 borderright">TM (1000/m²/Mois)</td>

                <td class="box-15 borderright"></td>

                <td class="box-15 borderright"><?= number_format((1000 *$facture->sb_size), 0, '', '.'); ?></td>

                <td class="box-15 text-right"><?= number_format($facture->tm_amount, 0, '', '.'); ?></td>

            </tr>
            <?php endif; ?>
        <tr>

            <td class="box-5 borderright"><?= $true_sb =$facture->sb_count -$facture->sb_p_count; ?></td>
            
            <td class="box-45 borderright">ODP (1000/m²/Mois)</td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"><?= number_format((1000 *$facture->sb_size), 0, '', '.'); ?></td>

            <td class="box-15 text-right"><?= number_format($facture->odp_amount, 0, '', '.'); ?></td>

        </tr>
        <?php elseif($facture->odp === "Non" &&$facture->tm_amount > 0): ?>
        <tr>

            <td class="box-5 borderright"><?=$facture->sb_count; ?></td>
            
            <td class="box-45 borderright">TM (1000/m²/Mois)</td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"><?= number_format((1000 *$facture->sb_size), 0, '', '.'); ?></td>

            <td class="box-15 text-right"><?= number_format($facture->tm_amount, 0, '', '.'); ?></td>

        </tr>
        <?php endif; ?>

        <?php if($facture->odp === "Oui" &&$facture->odp_p_amount > 0 &&$facture->sb_p_count > 0): ?>
            <?php if($facture->alcool_type === "Non" &&$facture->tm_amount > 0): ?>
            <tr>

                <td class="box-5 borderright"><?=$facture->sb_count; ?></td>
                
                <td class="box-45 borderright">TM (1000/m²/Mois)</td>

                <td class="box-15 borderright"></td>

                <td class="box-15 borderright"><?= number_format((1000 *$facture->sb_size), 0, '', '.'); ?></td>

                <td class="box-15 text-right"><?= number_format($facture->tm_amount, 0, '', '.'); ?></td>

            </tr>
            <?php endif; ?>
        <tr>

            <td class="box-5 borderright"><?= $true_sb =$facture->sb_p_count; ?></td>
            
            <td class="box-45 borderright">ODP-PLATEAU (4000/m²/Mois)</td>

            <td class="box-15 borderright"></td>

            <td class="box-15 borderright"><?= number_format((4000 *$facture->sb_size), 0, '', '.'); ?></td>

            <td class="box-15 text-right"><?= number_format($facture->odp_p_amount, 0, '', '.'); ?></td>

        </tr>
        <?php endif; ?>

        </tbody>

    </table>


    <table class="table-invoice">
        
        <thead><tr><th scope="col" colspan="2" class="text-uppercase">Récapitulative</th></tr></thead>

        <tbody>
        
        <?php if($facture->agree_tva === "Oui"): ?>    
        <tr>
            
            <td class="box-80 borderright text-uppercase text-right">Total ht</td>

            <td class="box-20 text-right"><?= number_format($facture->agency_remised_ht_price, 0, '', '.'); ?></td>

        </tr>
            <?php if($facture->tva > 0): ?>
            <tr>
                
                <td class="box-80 borderright text-uppercase text-right">Tva (18%)</td>

                <td class="box-20 text-right"><?= number_format($facture->tva, 0, '', '.'); ?></td>

            </tr>

            <tr>
                
                <td class="box-80 borderright text-uppercase text-right">Tsp (3%)</td>

                <td class="box-20 text-right"><?= number_format($facture->tsp, 0, '', '.'); ?></td>

            </tr>
            <?php endif; ?>

        <?php else: ?>  
        <tr>
            
            <td class="box-80 borderright text-uppercase text-right">Total ht</td>

            <td class="box-20 text-right">
                <?php $tht = ($facture->agency_remised_ht_price + $facture->transport_price + $facture->odp_amount + $facture->odp_p_amount + $facture->tm_alcool_amount + $facture->tm_amount); ?>
                <?= number_format($tht, 0, '', '.'); ?>
            </td>

        </tr>
        <?php endif; ?>

        </tbody>

    </table>


    <table class="table-invoice">
        
        <thead>

        <tr>

            <th scope="col" class="text-uppercase">Arrêtée la présente facture à la somme de</th>

            <th scope="col" class="text-right text-uppercase">Montant total <?= $facture->agree_tva === "Oui" ? 'TTC' : ''; ?></th>

        </tr>

        </thead>

        <tbody>
            
        <tr>
            
            <td class="box-70">
            <?php if($facture->agree_tva === "Oui"): ?>
            
                <?= $facture->letter_ttc_price . ' francs cfa ttc'; ?>

            <?php else: ?>
            
                <?= $facture->letter_ttc_price . ' francs cfa'; ?>

            <?php endif; ?>
            </td>

            <td class="box-30 text-right bg-green bolder ts-3x" style="color: #FFFFFF;"><?= number_format($facture->numeric_ttc_price, 0, '', '.'); ?></td>

        </tr>

        <tr>
            
            <td colspan="2">
                
                <small class="text-grey"><b class="text-danger">*</b> Tous les tarifs & montants sont exprimés en FCFA XOF</small><br>
                <small class="text-grey"><b class="text-danger">*</b> La TVA en République de Côte d'Ivoire est de 18%</small><br>
                <small class="text-grey"><b class="text-danger">*</b> La TSP désigne la TAXE SUR LA PUBLICITE, elle est de 3%</small>

            </td>

        </tr>    

        </tbody>

    </table>

</page>

<?php

$content = ob_get_clean();

try {
	
	$pdf = new Html2Pdf('P', 'A4', 'fr', 'true', 'UTF-8');

    $pdf->pdf->SetDisplayMode('fullpage');
	
	$pdf->writeHTML($content);
	
	$pdf->output($filename);

} catch(HTML2PDF_exception $e) {

	die($e);

}

?>