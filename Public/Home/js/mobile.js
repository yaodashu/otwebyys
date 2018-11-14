var browser={
    versions:function(){ 
        var u = navigator.userAgent, app = navigator.appVersion; 
            return {//�ƶ��ն�������汾��Ϣ 
                trident: u.indexOf('Trident') > -1, //IE�ں�
                presto: u.indexOf('Presto') > -1, //opera�ں�
                webKit: u.indexOf('AppleWebKit') > -1, //ƻ�����ȸ��ں�
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //����ں�
                mobile: !!u.match(/AppleWebKit.*Mobile.*/)||!!u.match(/AppleWebKit/), //�Ƿ�Ϊ�ƶ��ն�
                macintosh: u.indexOf('Macintosh') > -1, //mac�ն�
                ios: u.indexOf('Mac OS X') > -1, //ios�ն�
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android�ն˻���uc�����
                iphone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //�Ƿ�ΪiPhone����QQHD�����
                ipad: u.indexOf('iPad') > -1, //�Ƿ�iPad
                chrome: u.indexOf('Chrome') > -1, //�Ƿ�chrome
                webapp: u.indexOf('Safari') == -1 //�Ƿ�webӦ�ó���û��ͷ����ײ�
            };
    }(),
    language:(navigator.browserLanguage || navigator.language).toLowerCase()
}
if(browser.versions.mobile&&!browser.versions.chrome&&!browser.versions.ipad&&!browser.versions.macintosh){location.href=location.href.replace("yatai.dasn.com.cn","myatai.dasn.com.cn");}