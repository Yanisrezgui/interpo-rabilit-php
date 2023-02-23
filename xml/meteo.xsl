<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" encoding="UTF-8" indent="yes"/>
    <xsl:template match ="/">

        <div class="info-meteo">
            <xsl:for-each select="previsions/echeance">
                <xsl:if test="@hour = '3' ">
                    <div class="block-3h">
                    <div><h5 class="card-title"><xsl:value-of select="@timestamp"/></h5></div>
                        <div class="level">
                            <xsl:apply-templates select="temperature/level"/>
                        </div>
                        <div class="pluie">
                            <xsl:apply-templates select="pluie"/>
                        </div>
                        <div class="risque_neige">
                            <xsl:apply-templates select="risque_neige"/>
                        </div>
                        <div>
                                <p>Vent : <xsl:value-of select="vent_moyen/level"/></p>
                                <p>Humidité : <xsl:value-of select="humidite/level"/></p>   
                                <p>Risque de neige : <xsl:value-of select="risque_neige"/></p>   
                        </div>
                    </div>
                </xsl:if>

                <xsl:if test="@hour = '9' ">
                    <div class="block-9h">
                    <div><h5 class="card-title"><xsl:value-of select="@timestamp"/></h5></div>
                        <div>
                            <xsl:apply-templates select="temperature/level"/>
                        </div>
                        <div>
                            <xsl:apply-templates select="pluie"/>
                        </div>
                        <div>
                            <xsl:apply-templates select="risque_neige"/>
                        </div>
                        <div>
                                <p>Vent : <xsl:value-of select="vent_moyen/level"/></p>
                                <p>Humidité : <xsl:value-of select="humidite/level"/></p>   
                                <p>Risque de neige : <xsl:value-of select="risque_neige"/></p>   
                        </div>
                    </div>
                </xsl:if>

                <xsl:if test="@hour = '15' ">
                    <div class="block-15h">
                    <div><h5 class="card-title"><xsl:value-of select="@timestamp"/></h5></div>
                            <div>
                                <xsl:apply-templates select="temperature/level"/>
                            </div>
                            <div>
                                <xsl:apply-templates select="pluie"/>
                            </div>
                            <div>
                                <xsl:apply-templates select="risque_neige"/>
                            </div>
                            <div>
                                <p>Vent : <xsl:value-of select="vent_moyen/level"/></p>
                                <p>Humidité : <xsl:value-of select="humidite/level"/></p>   
                                <p>Risque de neige : <xsl:value-of select="risque_neige"/></p>   
                            </div>
                    </div>
                </xsl:if>
            </xsl:for-each>
        </div>
    </xsl:template>

    <xsl:template match="level">
        <xsl:if test="@val = 'sol' ">
            <p style="font-size: 20px; font-weight: 600;"><xsl:value-of select="round(. - 273.15)"/>°C</p>
            <xsl:choose>
                <xsl:when test=". >= 303.15">
                    <img class="image" src="https://cdn.icon-icons.com/icons2/1370/PNG/512/if-weather-3-2682848_90785.png" alt="sun" style="height: 35px;"/>
                </xsl:when>
                <xsl:when test=". >= 278.15">
                    <img class="image" src="https://d2p1ubzgqn8tkf.cloudfront.net/import/48358/lg_9d0b79e99eeaa83f9360edb3d4ebcb5f.jpg" alt="nuageux" style="height: 35px;"/>
                </xsl:when>
                <xsl:otherwise>
                    <img class="image" src="https://d2p1ubzgqn8tkf.cloudfront.net/import/43634/lg_a778c37ad4be408be1ef2cd12b65289a.jpg" alt="cold" style="height: 35px;"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:if>
    </xsl:template>

    <xsl:template match="pluie">
        <xsl:if test=".>=2">
            <img class="image" src="https://fyooyzbm.filerobot.com/v7/https://static01.nicematin.com/media/npo/xlarge/2015/02/61b19da99bcd6a1dd49dac11a8f9d4bf.png" alt="rain" style="height: 35px;"/>
        </xsl:if>
    </xsl:template>

    <xsl:template match="risque_neige" style="height: 35px;">
        <xsl:if test=". = 'oui' ">
            <img class="image" src="https://static01.nicematin.com/media/npo/1440w/2013/11/55aacea3edff7ef59f055810b0fb3b3b.png" alt="neige" style="height: 35px;"/>
        </xsl:if>
    </xsl:template>
</xsl:stylesheet>
