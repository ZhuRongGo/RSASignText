<?php
/**
 * Created by PhpStorm.
 * User: webff
 * Date: 2017/5/12
 * Time: 20:03
 */
class Rsa2
{
    private static $PRIVATE_KEY ="-----BEGIN PRIVATE KEY-----
MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAOQJ5p5R8VjtygDy
VGXSCq2u9pt5fhUeL5qG/ycOygFxQotN5V/XmYkAX9IXwLSg9XR0HW4FiCCES9/e
1E5Bi0UVy2sBHM7VH2RuGfsnSrP2VJgehRU8qh91cZLHzKLUD3Re41tfS1HRyLNY
WlLnWdssWisfzaSZ5SAMQnkx8j8vAgMBAAECgYEAqbGYdR4jTHr/RH8QQQjxu1ek
2gOpyItC/2oP+3+s4S/oRgO8efrVnTazF4NnesMAhR1XPSVOrGvmjnyiXm219VXi
bvWeac4F/1XRrk3S1iSEvV6D69uEXhPRZd0A/NyQhWgx3LAiFD6VNDkLD7P/b7D1
IqKg2d+BLPzd1F2C2skCQQD/TvnnOgJB64rrLUVJxHsxL2Heowc46BU130ihrkl4
Nm73ACrYOmp9XusztbTk+GoeC+Kp/8CD9W+V8gYlKzsDAkEA5KgEO0+lIpzafnZ0
eRL9nq34icZmWg3iFIfMT+XjlCovWURVIWvJc+65mKDwV9/MMOjgDIHdF4LD251u
+Yb9ZQJBAIuRrhYU5TUKQfhM2Er6aWo6/+LI9uLKJQY9WSRh9fIMt965rbJlRN/i
quuq0wg1MTXZw4Cxupmo6+Zp16gsGOcCQFsnF7jFQWGRAhFUC46QoYZ2eBQEgZz4
192zXSGk1ZqlTobZlM5j98U9r8NGtUlysCX3UAnsY0USHh4Ynrres3kCQCghBhD7
bTtqHCz+WEH9MuE60j1vSM0HPWejm99IE8BhHfgKxuQ9YvkKXm/vvwDmCvNyYEyU
1tn/Mc8zLjbh7YM=
-----END PRIVATE KEY-----
";
    private static $PUBLIC_KEY  = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDkCeaeUfFY7coA8lRl0gqtrvab
eX4VHi+ahv8nDsoBcUKLTeVf15mJAF/SF8C0oPV0dB1uBYgghEvf3tROQYtFFctr
ARzO1R9kbhn7J0qz9lSYHoUVPKofdXGSx8yi1A90XuNbX0tR0cizWFpS51nbLFor
H82kmeUgDEJ5MfI/LwIDAQAB
-----END PUBLIC KEY-----';



    /**
     * 获取私钥
     * @return bool|resource
     */
    private static function getPrivateKey()
    {
        $privKey = self::$PRIVATE_KEY;
        return openssl_pkey_get_private($privKey);
    }

    /**
     * 获取公钥
     * @return bool|resource
     */
    private static function getPublicKey()
    {
     
        $publicKey = self::$PUBLIC_KEY;
        return openssl_pkey_get_public($publicKey);
    }

    /**
     * 创建签名
     * @param string $data 数据
     * @return null|string
     */
    public function createSign($data = '')
    {
      //  var_dump(self::getPrivateKey());die;
        if (!is_string($data)) {
            return null;
        }
        return openssl_sign($data, $sign, self::getPrivateKey(),OPENSSL_ALGO_SHA256 ) ? base64_encode($sign) : null;
    }

    /**
     * 验证签名
     * @param string $data 数据
     * @param string $sign 签名
     * @return bool
     */
    public function verifySign($data = '', $sign = '')
    {
        if (!is_string($sign) || !is_string($sign)) {
            return false;
        }
        return (bool)openssl_verify(
            $data,
            base64_decode($sign),
            self::getPublicKey(),
            OPENSSL_ALGO_SHA256
        );
    }
}

	$rsa2 = new Rsa2();

	$data = 'mydata'; //待签名字符串

	$strSign = $rsa2->createSign($data);      //生成签名
	var_dump($strSign);

	$is_ok = $rsa2->verifySign($data, $strSign); //验证签名
	var_dump($is_ok);die;

