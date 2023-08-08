[{assign var="oConf" value=$oView->getConfig()}]
<input id="customSearchURL" type="hidden" value="[{$oConf->getConfigParam('customSearchURL')}]">
<input id="customSearchAuth" type="hidden" value="[{$oConf->getConfigParam('customSearchAuth')}]">
<input id="customSearchGroup" type="hidden" value="[{$oConf->getConfigParam('customSearchGroup')}]">
<input id="customSearchLinkTitle" type="hidden" value="[{oxmultilang ident="MORE"}]">
<input id="customSearchNavTitle" type="hidden" value="[{oxmultilang ident="CUSTOM_SEARCH_NAV_TITLE"}]">
<input id="customSearchNavSubTitle" type="hidden" value="[{oxmultilang ident="CUSTOM_SEARCH_NAV_SUB_TITLE"}]">
<script type="application/javascript" src="[{$oViewConf->getModuleUrl('pr_custom_search', 'out/src/js/search.js')}]">
