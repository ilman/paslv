function trim(str) {
	var	str = str.replace(/^\s\s*/, ''),
		ws = /\s/,
		i = str.length;
	while (ws.test(str.charAt(--i)));
	return str.slice(0, i + 1);
}

function round_number(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}



function convert_to_hundred(num) {
    aTens = ["Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
	aOnes = ["Nol", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan",
		"Sepuluh", "Sebelas"];
	
	var cNum, nNum;
    var cWords = "";

    num %= 1000;
    if (num > 99) {
        /* Hundreds. */
        cNum = String(num);
        nNum = Number(cNum.charAt(0));
		if(nNum==1){
        	cWords += " Seratus ";
		}
		else{
			cWords += aOnes[nNum] + " Ratus ";
		}
        num %= 100;
    }

    if (num > 19) {
        /* Tens. */
        cNum = String(num);
        nNum = Number(cNum.charAt(0));
        cWords += aOnes[nNum] + ' Puluh ';
        num %= 10;
    }

    if (num > 0) {
        /* Ones and teens. */
        nNum = Math.floor(num);
		
		if(nNum > 11){
			cWords += aOnes[nNum-10] + ' Belas ';
		}
		else{
        	cWords += aOnes[nNum];
		}
    }

    return cWords;
}

function convert_to_word(num) {
   var aUnits = ["Ribu", "Juta", "Miliar", "Triliun", "Quadrillion"];
   var cWords = '';
	var dWords = '';
	
	num = num.toString();
	num = num.replace(/[\,\. ]/g, '');
    
	var nLeft = Math.floor(num);
    for (var i = 0; nLeft > 0; i++) {
        if (nLeft % 1000 > 0) {
			dWords = convert_to_hundred(nLeft);
			
			if((dWords=='Satu') && i==1){
				cWords = "Seribu " + cWords;
			}
			else if (i != 0){
				cWords = dWords + " " + aUnits[i - 1] + " " + cWords;
			}
            else {
				cWords = dWords + " " + cWords;
			}
        }
        nLeft = Math.floor(nLeft / 1000);
    }
    num = Math.round(num * 100) % 100;

    return cWords.replace(/\s+/g,' ');
}