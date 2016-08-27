<?php foreach($macroscopia as $omacro):?>
	<tr>
	    <td width="40%"><?php echo $omacro->macro_ih;?></td>
	    <?php if($_SESSION['idperfil_anat']==1 or $_SESSION['idperfil_anat']==2 or $_SESSION['idperfil_anat']==6 or $_SESSION['idperfil_anat']==3):?> 
	    <td width="10%"><?php echo $omacro->tecnologo;?></td>
	    <?php endif?>
	</tr>
<?php endforeach;?>