<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace SmartCommerceSE\RooomIntegration\Controller\Admin;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use stdClass;
use OxidEsales\Eshop\Core\TableViewNameGenerator;

/**
 * Admin article main manager.
 * Collects and updates (on user submit) article base parameters data ( such as
 * title, article No., short Description and etc.).
 * Admin Menu: Manage Products -> Articles -> Main.
 */
class ArticleRooom extends \OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController
{
    /**
     * Loads article information - pictures, passes data to template engine
     * engine, returns name of template file "article_pictures".
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        $this->_aViewData["edit"] = $oArticle = oxNew(\OxidEsales\Eshop\Application\Model\Article::class);

        $soxId = $this->getEditObjectId();
        if (isset($soxId) && $soxId != "-1") {
            // load object
            $oArticle->load($soxId);
            

            // variant handling
            if ($oArticle->oxarticles__oxparentid->value) {
                $oParentArticle = oxNew(\OxidEsales\Eshop\Application\Model\Article::class);
                $oParentArticle->load($oArticle->oxarticles__oxparentid->value);
                $this->_aViewData["parentarticle"] = $oParentArticle;
                $this->_aViewData["oxparentid"] = $oArticle->oxarticles__oxparentid->value;
            }
        }

        if ($this->getViewConfig()->isAltImageServerConfigured()) {
            $config = Registry::getConfig();

            if ($config->getConfigParam('sAltImageUrl')) {
                $this->_aViewData["imageUrl"] = $config->getConfigParam('sAltImageUrl');
            } else {
                $this->_aViewData["imageUrl"] = $config->getConfigParam('sSSLAltImageUrl');
            }
        }

        return "@r3d_rooomintegrationmodule/admin/tpl/article_rooom";
    }

    /**
     * Saves (uploads) pictures to server.
     *
     * @return mixed
     */
    public function save()
    {
    
        $logger = Registry::getLogger();
        $editvalues = Registry::getRequest()->getRequestEscapedParameter("editval");
        parent::save();

        $oArticle = oxNew(\OxidEsales\Eshop\Application\Model\Article::class);
       
         $aFiles = $aFiles ? $aFiles : $_FILES;
         
         
         
         
         if (isset($aFiles['r3dimagefile']['name'])&& strlen( trim($aFiles['r3dimagefile']['name'])) > 0) {
         
		 try {    
			 Registry::getUtilsFile()-> processFile('r3dimagefile', 'out/pictures/r3dimagefiles/'.$editvalues['article__oxid']);
			 $editvalues['oxarticles__r3dimage']=$aFiles['r3dimagefile']['name'];
 			 $this->makeReadable(Registry::getConfig()->getConfigParam('sShopDir'),'out/pictures/r3dimagefiles/'.$editvalues['article__oxid']);
			 
		 }//catch exception thrown by processFile only
		 catch(\OxidEsales\Eshop\Core\Exception\StandardException $e) {
	 
		   $oEx = oxNew(\OxidEsales\Eshop\Core\Exception\ExceptionToDisplay::class);
	  
		   $oEx->setMessage($e->getMessage());
	 
		   Registry::getUtilsView()->addErrorToDisplay($oEx, false);
		   return;
		 }
         }
        
        if ($oArticle->load($this->getEditObjectId())) {
        $oArticle->assign($editvalues);
        $oArticle->save();
        }
    }

    protected function makeReadable($sBase,$sTarget)
    {   $sPath=$sBase;
        $aElememts = explode("/", $sTarget);
         $logger = Registry::getLogger();
        foreach($aElememts as $sElement){
        $logger->error("path" . $sPath);
        $sPath .= "/".$sElement;
        @chmod($sPath, 0775);
       
        }
    }

    /**
     * Deletes thumbnail file
     *
     * @param \OxidEsales\Eshop\Application\Model\Article $oArticle article object
     */
    protected function deleteThumbnail($oArticle)
    {
        if ($this->canDeleteThumbnail($oArticle)) {
            if (!$oArticle->isDerived()) {
                $oPicHandler = Registry::getPictureHandler();
                $oPicHandler->deleteThumbnail($oArticle);
            }

            //reseting field
            $oArticle->oxarticles__oxthumb = new \OxidEsales\Eshop\Core\Field();
        }
    }

   

   
    /**
     * Checks if possible to delete thumbnail of article.
     *
     * @param \OxidEsales\Eshop\Application\Model\Article $oArticle
     *
     * @return bool
     */
    protected function canDeleteThumbnail($oArticle)
    {
        return (bool) $oArticle->oxarticles__oxthumb->value;
    }
}
