<?php foreach($resultados as $oresult):?>
    <tr>
        
        <td width="15%"><?php echo $oresult->descr_marcador;?></td>
        <td width="30%"><?php echo $oresult->resultado;?></td>
        <td class ="center" width="8%">
        <input type="hidden" id="idbiopsia" value="<?php echo $id_biopsia; ?>" />
            <div data=<?php echo $oresult->id_marc_prueba; ?>>
             <a class="red" id="eliminarmarcad">
             <i class="icon-trash bigger-130" ></i>
             </a>
            </div>
                
        </td>             
             
    </tr>
<?php endforeach;?>
