/* ==========================================================
 * bootstrap-formhelpers-phone.format.js
 * https://github.com/vlamanna/BootstrapFormHelpers
 * ==========================================================
 * Copyright 2012 Vincent Lamanna
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file edcept in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either edpress or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

var BFHPhoneFormatList = {
    'AF': '0dd ddd dddd',
    'AL': '0dd ddd ddd',
    'DZ': '0ddd dd dd dd',
    'AS': '(ddd) ddd-dddd',
    'AD': 'ddddddddd',
    'AO': 'ddd ddd ddd',
    'AI': '(ddd) ddd-dddd',
    'AQ': 'ddddddddd'  ,
    'AG': '(ddd) ddd-dddd' ,
    'AR': 'ddddddddd' ,
    'AM': '0dd dddddd' ,
    'AW': 'ddd dddd' ,
    'AU': 'ddd ddd ddd' ,
    'AT': '0dddd ddddddddd' ,
    'AZ': 'ddddddddd'  ,
    'BH': 'ddddddddd' ,
    'BD': 'ddddddddd',
    'BB': 'ddddddddd'  ,
    'BY': 'ddddddddd',
    'BE': 'ddddddddd',
    'BZ': 'ddddddddd',
    'BJ': 'ddddddddd',
    'BM': '(ddd) ddd-dddd',
    'BT': 'ddddddddd',
    'BO': 'ddddddddd',
    'BA': 'ddddddddd',
    'BW': 'ddddddddd',
    'BV': 'ddddddddd',
    'BR': 'ddddddddd',
    'IO': 'ddddddddd',
    'VG': '(ddd) ddd-dddd',
    'BN': 'ddddddddd',
    'BG': 'ddddddddd',
    'BF': 'ddddddddd',
    'BI': 'ddddddddd',
    'CI': 'ddddddddd',
    'KH': 'ddddddddd',
    'CM': 'ddddddddd',
    'CA': '(ddd) ddd-dddd',
    'CV': 'ddddddddd',
    'KY': '(ddd) ddd-dddd',
    'CF': 'ddddddddd',
    'TD': 'ddddddddd',
    'CL': 'ddddddddd',
    'CN': 'ddddddddd',
    'CX': 'ddddddddd',
    'CC': 'ddddddddd',
    'CO': 'ddddddddd',
    'KM': 'ddddddddd',
    'CG': 'ddddddddd',
    'CK': 'ddddddddd',
    'CR': 'ddddddddd',
    'HR': 'ddddddddd',
    'CU': 'ddddddddd',
    'CY': 'ddddddddd',
    'CZ': 'ddddddddd',
    'CD': 'ddddddddd',
    'DK': 'ddddddddd',
    'DJ': 'ddddddddd',
    'DM': '(ddd) ddd-dddd',
    'DO': '(ddd) ddd-dddd',
    'TL': 'ddddddddd',
    'EC': 'ddddddddd',
    'EG': 'ddddddddd',
    'SV': 'ddddddddd',
    'GQ': 'ddddddddd',
    'ER': 'ddddddddd',
    'EE': 'ddddddddd',
    'ET': 'ddddddddd',
    'FO': 'ddddddddd',
    'FK': 'ddddddddd',
    'FJ': 'ddddddddd',
    'FI': 'ddddddddd',
    'MK': 'ddddddddd',
    'FR': 'dd dd dd dd dd',
    'GF': 'ddddddddd',
    'PF': 'ddddddddd',
    'TF': 'ddddddddd',
    'GA': 'ddddddddd',
    'GE': 'ddddddddd',
    'DE': 'ddddddddd',
    'GH': 'ddddddddd',
    'GI': 'ddddddddd',
    'GR': 'ddddddddd',
    'GL': 'ddddddddd',
    'GD': '(ddd) ddd-dddd',
    'GP': 'ddddddddd',
    'GU': '(ddd) ddd-dddd',
    'GT': 'ddddddddd',
    'GN': 'ddddddddd',
    'GW': 'ddddddddd',
    'GY': 'ddddddddd',
    'HT': 'ddddddddd',
    'HM': 'ddddddddd',
    'HN': 'ddddddddd',
    'HK': 'ddddddddd',
    'HU': 'ddddddddd',
    'IS': 'ddddddddd',
    'IN': 'ddddddddd',
    'ID': 'ddddddddd',
    'IR': 'ddddddddd',
    'IQ': 'ddddddddd',
    'IE': 'ddddddddd',
    'IL': 'ddddddddd',
    'IT': 'ddddddddd',
    'JM': '(ddd) ddd-dddd',
    'JP': 'ddddddddd',
    'JO': 'ddddddddd',
    'KZ': 'ddddddddd',
    'KE': 'ddddddddd',
    'KI': 'ddddddddd',
    'KW': 'ddddddddd',
    'KG': 'ddddddddd',
    'LA': 'ddddddddd',
    'LV': 'ddddddddd',
    'LB': 'ddddddddd',
    'LS': 'ddddddddd',
    'LR': 'ddddddddd',
    'LY': 'ddddddddd',
    'LI': 'ddddddddd',
    'LT': 'ddddddddd',
    'LU': 'ddddddddd',
    'MO': 'ddddddddd',
    'MG': 'ddddddddd',
    'MW': 'ddddddddd',
    'MY': 'ddddddddd',
    'MV': 'ddddddddd',
    'ML': 'ddddddddd',
    'MT': 'ddddddddd',
    'MH': 'ddddddddd',
    'MQ': 'ddddddddd',
    'MR': 'ddddddddd',
    'MU': 'ddddddddd',
    'YT': 'ddddddddd',
    'MX': 'ddddddddd',
    'FM': 'ddddddddd',
    'MD': 'ddddddddd',
    'MC': 'ddddddddd',
    'MN': 'ddddddddd',
    'MS': '(ddd) ddd-dddd',
    'MA': 'ddddddddd',
    'MZ': 'ddddddddd',
    'MM': 'ddddddddd',
    'NA': 'ddddddddd',
    'NR': 'ddddddddd',
    'NP': 'ddddddddd',
    'NL': 'ddddddddd',
    'AN': 'ddddddddd',
    'NC': 'ddddddddd',
    'NZ': 'ddddddddd',
    'NI': 'ddddddddd',
    'NE': 'ddddddddd',
    'NG': 'ddddddddd',
    'NU': 'ddddddddd',
    'NF': 'ddddddddd',
    'KP': 'ddddddddd',
    'MP': '(ddd) ddd-dddd',
    'NO': 'ddddddddd',
    'OM': 'ddddddddd',
    'PK': 'ddddddddd',
    'PW': 'ddddddddd',
    'PA': 'ddddddddd',
    'PG': 'ddddddddd',
    'PY': 'ddddddddd',
    'PE': 'ddddddddd',
    'PH': 'ddddddddd',
    'PN': 'ddddddddd',
    'PL': 'ddddddddd',
    'PT': 'ddddddddd',
    'PR': '(ddd) ddd-dddd',
    'QA': 'ddddddddd',
    'RE': 'ddddddddd',
    'RO': 'ddddddddd',
    'RU': 'ddddddddd',
    'RW': 'ddddddddd',
    'ST': 'ddddddddd',
    'SH': 'ddddddddd',
    'KN': '(ddd) ddd-dddd',
    'LC': '(ddd) ddd-dddd',
    'PM': 'ddddddddd',
    'VC': '(ddd) ddd-dddd',
    'WS': 'ddddddddd',
    'SM': 'ddddddddd',
    'SA': 'ddddddddd',
    'SN': 'ddddddddd',
    'SC': 'ddddddddd',
    'SL': 'ddddddddd',
    'SG': 'ddddddddd',
    'SK': 'ddddddddd',
    'SI': 'ddddddddd',
    'SB': 'ddddddddd',
    'SO': 'ddddddddd',
    'ZA': 'ddddddddd',
    'GS': 'ddddddddd',
    'KR': 'ddddddddd',
    'ES': 'ddddddddd',
    'LK': 'ddddddddd',
    'SD': 'ddddddddd',
    'SR': 'ddddddddd',
    'SJ': 'ddddddddd',
    'SZ': 'ddddddddd',
    'SE': 'ddddddddd',
    'CH': 'ddddddddd',
    'SY': 'ddddddddd',
    'TW': 'ddddddddd',
    'TJ': 'ddddddddd',
    'TZ': 'ddddddddd',
    'TH': 'ddddddddd',
    'BS': '(ddd) ddd-dddd',
    'GM': 'ddddddddd',
    'TG': 'ddddddddd',
    'TK': 'ddddddddd',
    'TO': 'ddddddddd',
    'TT': '(ddd) ddd-dddd',
    'TN': 'ddddddddd',
    'TR': 'ddddddddd',
    'TM': 'ddddddddd',
    'TC': '(ddd) ddd-dddd',
    'TV': 'ddddddddd',
    'VI': '(ddd) ddd-dddd',
    'UG': 'ddddddddd',
    'UA': 'ddddddddd',
    'AE': 'ddddddddd',
    'GB': '(ddd) dddd dddd',
    'US': '(ddd) ddd-dddd',
    'UM': 'ddddddddd',
    'UY': 'ddddddddd',
    'UZ': 'ddddddddd',
    'VU': 'ddddddddd',
    'VA': 'ddddddddd',
    'VE': 'ddddddddd',
    'VN': 'ddddddddd',
    'WF': 'ddddddddd',
    'EH': 'ddddddddd',
    'YE': 'ddddddddd',
    'YU': 'ddddddddd',
    'ZM': 'ddddddddd',
    'ZW': 'ddddddddd'
}