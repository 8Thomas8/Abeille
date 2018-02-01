#!/bin/bash
set -x
function arret
{
  echo
  echo "Avancement: 99% ---------------------------------------------------------------------------------------------------> ;-) "
  echo

  echo "Fin installation des dépendances"

  echo
  echo "Avancement: 100% ---------------------------------------------------------------------------------------------------> FIN"
  echo

  echo 100 > ${PROGRESS_FILE}
  sleep 3
  rm ${PROGRESS_FILE}

}

function arretSiErreur
{
  echo
  echo "***************"
  echo $1
  echo "***************"
  echo

  arret
  exit 1
}

echo "Début d'installation des dépendances"

PROGRESS=/tmp/jeedom/Abeille/dependancy_abeille_in_progress

if [ ! -z $1 ]; then
	PROGRESS_FILE=$1
fi
touch ${PROGRESS_FILE}

echo 0 > ${PROGRESS_FILE}
echo
echo "Avancement: 0% ---------------------------------------------------------------------------------------------------> Environnement "
echo

cmd=`id`
echo "id: "$cmd

cmd=`pwd`
echo "pwd: "$cmd

cmd=`uname -a`
echo "uname -a: "$cmd

if [ -d "/etc/php5/fpm/" ]; then
  echo "system tourne avec fpm et php5"
  SERVICE="php5-fpm"
elif [ -d "/etc/php5/apache2/" ]; then
  echo "system tourne avec apache2 et php5"
  SERVICE="apache2"
elif [ -d "/etc/php/7.0/fpm/" ]; then
  echo "system tourne avec fpm et php7"
  SERVICE="php7-fpm"
elif [ -d "/etc/php/7.0/apache2" ]; then
  echo "system tourne avec apache2 et php7"
  SERVICE="apache2"
else
  arretSiErreur "Erreur critique, je ne reconnais pas le system (apache, php,...)"
fi

echo 5 > ${PROGRESS_FILE}
echo
echo "Avancement: 5% ---------------------------------------------------------------------------------------------------> Install lsb-release php-pear"
echo

apt-get -y install lsb-release php-pear

echo 8 > ${PROGRESS_FILE}
echo
echo "Avancement: 8% ---------------------------------------------------------------------------------------------------> Ajout repo mosquitto"
echo

if [ -f mosquitto-repo.gpg.key ]; then
echo "Efface ancien mosquitto-repo.gpg.key"
rm mosquitto-repo.gpg.key
fi

wget http://repo.mosquitto.org/debian/mosquitto-repo.gpg.key
apt-key add mosquitto-repo.gpg.key

if [ -f mosquitto-repo.gpg.key ]; then
echo "Efface ancien mosquitto-repo.gpg.key"
rm mosquitto-repo.gpg.key
fi

# Test sur l archi mais en fait on fait la meme chose, je garde le test si on devait en avoir besoin.
archi=`lscpu | grep Architecture | awk '{ print $2 }'`
echo "Architecture: "$archi

if [ "$archi" == "x86_64" ]; then

  if [ `lsb_release -i -s` == "Debian" ]; then

    echo "Release trouvée: Debian"

    if [ `lsb_release -c -s` == "jessie" ]; then
      echo "Version trouvée: jessie"

      if [ -f /etc/apt/sources.list.d/mosquitto-jessie.list ]; then
        echo "Efface ancien /etc/apt/sources.list.d/mosquitto-jessie.list"
        rm /etc/apt/sources.list.d/mosquitto-jessie.list
      fi

      wget http://repo.mosquitto.org/debian/mosquitto-jessie.list -O /etc/apt/sources.list.d/mosquitto-jessie.list

    elif [ `lsb_release -c -s` == "stretch" ]; then

      if [ -f /etc/apt/sources.list.d/mosquitto-jessie.list ]; then
        echo "Efface ancien /etc/apt/sources.list.d/mosquitto-jessie.list"
        rm /etc/apt/sources.list.d/mosquitto-stretch.list
      fi

      wget http://repo.mosquitto.org/debian/mosquitto-stretch.list -O /etc/apt/sources.list.d/mosquitto-stretch.list

    else
        echo "Erreur critique: je ne connais pas cette version."
        arretSiErreur "Erreur critique: je ne connais pas cette version."
    fi

  else
    echo "Erreur critique: je ne connais pas cette distribution."
    arretSiErreur "Erreur critique: je ne connais pas cette distribution."
  fi

elif [ "$archi" == "armv7l" ] || [ "$archi" == "armv6l" ]; then

  if [ `lsb_release -i -s` == "Raspbian" ]; then

    if [ `lsb_release -c -s` == "jessie" ]; then
      echo "Version trouvée: jessie"

      if [ -f /etc/apt/sources.list.d/mosquitto-jessie.list ]; then
        echo "Efface ancien /etc/apt/sources.list.d/mosquitto-jessie.list"
        rm /etc/apt/sources.list.d/mosquitto-jessie.list
      fi

      wget http://repo.mosquitto.org/debian/mosquitto-jessie.list -O /etc/apt/sources.list.d/mosquitto-jessie.list

    elif [ `lsb_release -c -s` == "stretch" ]; then

      if [ -f /etc/apt/sources.list.d/mosquitto-jessie.list ]; then
        echo "Efface ancien /etc/apt/sources.list.d/mosquitto-jessie.list"
        rm /etc/apt/sources.list.d/mosquitto-stretch.list
      fi

      wget http://repo.mosquitto.org/debian/mosquitto-stretch.list -O /etc/apt/sources.list.d/mosquitto-stretch.list

    else
      echo "Erreur critique: je ne connais pas cette version."
      arretSiErreur "Erreur critique: je ne connais pas cette version."
    fi

  else
    echo "Erreur critique: je ne connais pas cette distribution."
    arretSiErreur "Erreur critique: je ne connais pas cette distribution."
  fi

else
  echo "Erreur critique: Je ne connais pas ce type de HW."
  arretSiErreur "Erreur critique: Je ne connais pas ce type de HW."
fi

echo 10 > ${PROGRESS_FILE}
echo
echo "Avancement: 10% ---------------------------------------------------------------------------------------------------> Update list package"
echo

apt-get update

echo 30 > ${PROGRESS_FILE}
echo
echo "Avancement: 30% ---------------------------------------------------------------------------------------------------> install mosquiito packages"
echo

apt-get -y install mosquitto mosquitto-clients libmosquitto-dev


if [[ -d "/etc/php5/" ]]; then
  echo 70 > ${PROGRESS_FILE}
  echo
  echo "Avancement: 70% ---------------------------------------------------------------------------------------------------> php5 deja present on installe php-dev et les librairies mosquitto"
  echo

  apt-get -y install php5-dev

  if [[ -d "/etc/php5/cli/" && ! `cat /etc/php5/cli/php.ini | grep "mosquitto"` ]]; then
    echo "" | pecl install Mosquitto-alpha
    echo "extension=mosquitto.so" | tee -a /etc/php5/cli/php.ini
  fi

  if [[ -d "/etc/php5/fpm/" && ! `cat /etc/php5/fpm/php.ini | grep "mosquitto"` ]]; then
    echo "extension=mosquitto.so" | tee -a /etc/php5/fpm/php.ini
  fi

  if [[ -d "/etc/php5/apache2/" && ! `cat /etc/php5/apache2/php.ini | grep "mosquitto"` ]]; then
    echo "extension=mosquitto.so" | tee -a /etc/php5/apache2/php.ini
  fi

else
  echo 70 > ${PROGRESS_FILE}
  echo
  echo "Avancement: 70% ---------------------------------------------------------------------------------------------------> php5 pas present on installe php7-dev et les librairies mosquitto"
  echo

  apt-get -y install php7.0-dev

  if [[ -d "/etc/php/7.0/cli/" && ! `cat /etc/php/7.0/cli/php.ini | grep "mosquitto"` ]]; then
    echo "" | pecl install Mosquitto-alpha
    echo "extension=mosquitto.so" | tee -a /etc/php/7.0/cli/php.ini
  fi

  if [[ -d "/etc/php/7.0/fpm/" && ! `cat /etc/php/7.0/fpm/php.ini | grep "mosquitto"` ]]; then
    echo "extension=mosquitto.so" | tee -a /etc/php/7.0/fpm/php.ini
  fi

  if [[ -d "/etc/php/7.0/apache2/" && ! `cat /etc/php/7.0/apache2/php.ini | grep "mosquitto"` ]]; then
    echo "extension=mosquitto.so" | tee -a /etc/php/7.0/apache2/php.ini
  fi

fi

echo 90 > ${PROGRESS_FILE}
echo
echo "Avancement: 90% ---------------------------------------------------------------------------------------------------> Demarrage des services."
echo


echo "**Ajout du user www-data dans le groupe dialout (accès à la zigate)**"
if [[ `groups www-data | grep -c dialout` -ne 1 ]]; then
    useradd -g dialout www-data
    if [ $? -ne 0 ]; then
            echo "Erreur lors de l'ajout de l utilisateur www-data au groupe dialout"
        else
            echo "OK, utilisateur www-data ajouté dans le groupe dialout"
    fi
    else
        echo "OK, utilisateur www-data est déja dans le group dialout"
 fi

echo 100 > ${PROGRESS_FILE}
echo
echo "Avancement: 99% ---------------------------------------------------------------------------------------------------> ;-) "
echo
echo "Fin installation des dépendances"
echo
echo "Avancement: 100% ---------------------------------------------------------------------------------------------------> FIN"
echo

rm ${PROGRESS_FILE}


# Docker detection, may be useful to add RPI detection here.
if [[ $(grep -c docker /proc/1/cgroup) -gt 0 ]]; then
  echo "I'm running on docker".
  /etc/init.d/mosquitto start

  if [[ "apache2" == ${SERVICE} ]]; then
    apache2ctl restart &
  else
    /etc/init.d/${SERVICE} restart
  fi
# Pour tous les autres systemes/
else
  /etc/init.d/mosquitto restart &
  sleep 5
  /etc/init.d/${SERVICE} restart &

fi




