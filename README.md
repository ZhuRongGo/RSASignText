### PHP RSA2 签名算法

RSA2是在原来SHA1WithRSA签名算法的基础上，新增了支持SHA256WithRSA的签名算法。

该算法在摘要算法上比SHA1WithRSA有更强的安全能力。

SHA1WithRSA的签名算法会继续提供支持，但为了您的应用安全，强烈建议使用SHA256WithRSA的签名算法。