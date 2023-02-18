<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:strip-space elements="previsions"/>
<xsl:output method="html" encoding="UTF-8" indent="yes"/>
    
    <xsl:template match="/">
        <html>
        <head>
        </head>
        <body>
            <xsl:apply-templates />
        </body>
        </html>
    </xsl:template>

    <xsl:template match="previsions">
        <xsl:apply-templates />
    </xsl:template>
</xsl:stylesheet>
