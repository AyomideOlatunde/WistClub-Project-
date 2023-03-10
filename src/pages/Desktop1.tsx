import { FunctionComponent } from "react";
import styles from "./Desktop1.module.css";

const Desktop1: FunctionComponent = () => {
  return (
    <div className={styles.desktop1}>
      <div className={styles.loginSect}>
        <div className={styles.login}>LOGin</div>
        <div className={styles.loginSectChild} />
        <div className={styles.loginSectItem} />
        <div className={styles.createAccount}>create account</div>
        <div className={styles.or}>or</div>
      </div>
      <img className={styles.bgGlowIcon} alt="" src="/bg-glow.svg" />
      <img className={styles.wistLogo1Icon} alt="" src="/wist-logo-1@2x.png" />
      <div className={styles.navbar}>
        <b className={styles.wist}>WIST</b>
        <div className={styles.about}>about</div>
        <div className={styles.pricing}>pricing</div>
        <div className={styles.contact}>contact</div>
        <div className={styles.buynfts}>buynfts</div>
      </div>
    </div>
  );
};

export default Desktop1;
